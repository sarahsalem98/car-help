<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentForProvider;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\StoreProductOrder;
use App\Http\Requests\StorePublicPrivateOrder;
use App\Models\Cart;
use App\Models\ClientCancellation;
use App\Models\CommentAndRate;
use App\Models\OrderPrice;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\Provider\ProductController;
use App\Http\Controllers\SendNotificationController;

class OrderController extends Controller
{

    public $publicPrivateOrderStatus = [1, 4, 5];
    //1->قيد التنفيذ
    //4->مكتمله
    //5->ملغاه
    public $order_type = [0, 1, 2];
    //0->public,
    //1->private,
    //2->products







    public function makePublicPrivateOrder(StorePublicPrivateOrder $request)
    {

        $validateData = $request->validated();
        if ($validateData['order_type'] == 0 || $validateData['order_type'] == 1) {
            $order = new Order;
            $order->fill($validateData);
            $order->client_id = Auth::user()->id;
            $name = Auth::user()->name;
            if ($request->hasfile('images')) {

                foreach ($request->file('images') as $image) {
                    $name = $image->store('public_private_order_images');
                    $data[] = $name;
                }
                $order->images = json_encode($data);
            }
            $order->save();

            return response()->json([
                'message' => 'order was created successfully',
                'order' => $order
            ], 201);

            SendNotificationController::sendNotification(
                $request,
                0,
                $order->id,
                $order->order_type,
                ' طلب جديد',
                "{$name}لديك طلب جديد من "
            );
        } else {
            return response()->json(['errors' => 'this order type is not public or private '], 400);
        }
    }



    public function makeProductOrder(StoreProductOrder $request)
    {
        $id = Auth::user()->id;
        $carts = Cart::where('client_id', $id)->get();
        if (!$carts->isEmpty()) {
            $validateData = $request->validated();
            if ($validateData['order_type'] == 2) {
                $order = new Order;
                $order->fill($validateData);
                $order->client_id = $id;
                $order->save();
                //    $order=Order::find(3);
                foreach ($carts as $cart) {
                    $order->product()->attach($cart->product_id, [
                        'qty' => $cart->qty,
                        'total_price' => $cart->total_price
                    ]);

                    $product = Product::find($cart->product_id);
                    $product->qty = ($product->qty) - ($cart->qty);
                    if ($product->qty == 0) {
                      //TODO:notify
                    }
                    $product->save();
                    $cart->delete();
                }

                return response()->json([
                    'message' => 'product order has been made succefully',
                    'order' => $order->with('product')->get()
                ], 201);
            } else {
                return response()->json(['errors' => 'this order type is not product order'], 400);
            }
        } else {
            return response()->json(['errors' => 'cart is empty'], 204);
        }

        //دفع
    }

    public function showPublicOrders()
    {
        $id = Auth::user()->id;
        $orders = Order::where('order_type', 0)->where('client_id', $id)->with('client.city', 'car')->get();
        if ($orders) {

            return response()->json(['orders' => $orders], 200);
        } else {
            return response()->json(['errors' => "no public orders found"], 404);
        }
    }

    public function showPrivateOrders()
    {
        $id = Auth::user()->id;
        $orders = Order::where('order_type', 1)->where('client_id', $id)->with('client.city', 'car')->get();
        if ($orders) {

            return response()->json(['orders' => $orders], 200);
        } else {
            return response()->json(['errors ' => "no private orders found"], 404);
        }
    }


    public function showSpecificPublicOrPrivateOrder($order_id)
    {
        $order = Order::where('id', $order_id)->with('provider', 'client.address', 'price.provider', 'clientCancel.reason', 'car')->get();
        return response()->json(["order" => $order], 200);
    }



    public function acceptPrice($price_id, $order_id)
    {
        $price = OrderPrice::where('id', $price_id)->where('order_id', $order_id)->get()[0];
        $order = Order::find($order_id);
        OrderPrice::where('id', '!=', $price_id)->where('order_id', $order_id)->delete();

        if ($order->provider_id == null) {
            $order->provider_id = $price->provider_id;
        }
        $order->status = $this->publicPrivateOrderStatus[0];
        $order->save();
        //الاشعارات
        return response()->json(['message' => "this price is accepted and other prices for the same order is deleted"], 200);
    }

    public function refusePrice($price_id, $order_id)
    {
        OrderPrice::where('id', $price_id)->where('order_id', $order_id)->delete();
        //الاشعارات
        return response()->json(['message' => "this price is deleted"], 200);
    }

    public function cancelOrder(Request $request)
    {

        $data = $request->validate([
            'order_id' => 'required',
            'cancel_id' => 'required',
        ]);

        $order = Order::find($data['order_id']);
        if ($order->status == 0) {
            $cancel = new ClientCancellation;
            $cancel->order_id = $data['order_id'];
            $cancel->client_id = Auth::user()->id;
            $cancel->cancel_id = $data['cancel_id'];
            $cancel->save();
            $order->status = $this->publicPrivateOrderStatus[2];
            $order->save();
            return response()->json(['message' => 'cancelation reason has been added to this order'], 201);
        } else {
            return response()->json(['message' => 'you are not allowed to cancel this order'], 405);
        }

        //دفع

    }
    public function allOrders()
    {
        $id = Auth::user()->id;
        $orders = Order::where('client_id', $id)->with('provider', 'client.address', 'price.provider', 'clientCancel.reason', 'car')->get();
        return response()->json(['orders' => $orders]);
    }
}
