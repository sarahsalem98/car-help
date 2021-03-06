<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SendNotificationController;
use App\Http\Requests\StorePriceForPublicPrivaterders;
use App\Models\OrderPrice;
use App\Models\Provider;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProviderCancellation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public $orderStatus = [1, 2, 3, 4, 5];
    //1->قيد التنفيذ
    //2->تم التجهيز
    //3->تم الاستلام
    //4->مكتمله
    //5->ملغاه

    public  function mainPage()
    {
        $id = Auth::user()->id;
        $newOrdersCount = Order::where('status', 0)->where('provider_id', $id)->orWhere('provider_id', null)->count();
        $nowOrdersCount = Order::where('provider_id', $id)->whereIn('status', [1, 2])->count();
        $finishedOrdersCount = Order::where('status', 3)->where('provider_id', $id)->count();
        $canceledOrdersCount = Order::where('status', 4)->where('provider_id', $id)->count();
        $providerProducts = Product::where('provider_id', $id)->sum('qty');
        return response()->json([
            'new_orders_count ' => $newOrdersCount,
            'now_orders_count' => $nowOrdersCount,
            'finished_orders_count' => $finishedOrdersCount,
            'canceled_orders_count' => $canceledOrdersCount,
            'provider_products' => $providerProducts
        ], 200);
    }





    public function addServicePrice(StorePriceForPublicPrivaterders $request)
    {
        $validatedDate = $request->validated();
        $order = Order::where('id', $validatedDate['order_id'])->get()[0];
        $auth = Auth::user()->enginner_name;
        if ($order->status == 0) {
            if ($order->provider_id == null || $order->provider_id == Auth::user()->id) {
                $price = new OrderPrice;
                $price->fill($validatedDate);
                $price->provider_id = Auth::user()->id;
                $price->save();
                SendNotificationController::sendNotification(
                    $order->client_id,
                    1,
                    $order->id,
                    $order->order_type,
                    ' عرض سعر جديد',
                    "{$auth}لديك عرض سعر جديد  من ",
                    "new offer ",
                    " you have new offer from {$auth}"
                );
                return response()->json([
                    'message' => "price added successfully to this order {$request->order_id}",
                    'price' => $price
                ], 201);
            } else {
                return response()->json(['message' => 'you are not allowed to add price this order'], 405);
            }
        } else {
            return response()->json(['message' => 'this order has already taken '], 400);
        }
    }


    public function showProviderServices()
    {
        $id = Auth::user()->id;
        $name = Auth::user()->enginner_name;
        $orders = Order::where('provider_id', $id)->whereIn('order_type', [0, 1])->orWhere('provider_id', null)->with('car', 'client', 'price', 'comment', 'providerCancel.reason')->get();
        return response()->json(["orders" => $orders], 200);
    }



    public function showSpecificOrder($order_id)
    {
        $id = Auth::user()->id;
        $order = Order::where('id', $order_id)->with('car', 'client', 'price', 'address', 'providerCancel.reason', 'clientCancel.reason', 'comment', 'product')->get();
        return response()->json(["order" => $order], 200);
    }


    public function cancelOrder(Request $request)
    {

        $data = $request->validate([
            'order_id' => 'required',
            'cancel_id' => 'required',
        ]);
        $auth = Auth::user()->enginner_name;
        $order = Order::find($data['order_id']);
        if ($order->status == 0 && $order->provider_id == Auth::user()->id) {
            $cancel = new ProviderCancellation;
            $cancel->order_id = $data['order_id'];
            $cancel->provider_id = Auth::user()->id;
            $cancel->cancel_id = $data['cancel_id'];
            $cancel->save();
            $order->status = $this->orderStatus[4];
            $order->save();
            SendNotificationController::sendNotification(
                $order->client_id,
                1,
                $order->id,
                $order->order_type,
                'الغاء طلب',
                "طلبك رقم {$order->id} تم الغاؤه من قبل {$auth}",
                "order canceled ",
                " your order from was canceled by {$auth}"
            );

            return response()->json(['message' => 'cancelation reason has been added to this service'], 201);
        } else {
            return response()->json(['message' => 'you are not allowed to cancel this service'], 405);
        }

        //دفع


    }

    public function completeService($service_id)
    {
        $auth=Auth::user()->enginner_name;
        $service = Order::find($service_id);
        if ($service->status == $this->orderStatus[0] || $service->status == $this->orderStatus[2]) {
            $service->status = $this->orderStatus[3];
            $service->save();
            SendNotificationController::sendNotification(
                $service->client_id,
                1,
                $service->id,
                $service->order_type,
                'اكتمال طلب',
                "تم اكتمال طلبك رقم {$service->id} من قبل {$auth}",
                " order is completed",
                " your order {$service->id} is completed by {$auth}"
            );
            return response()->json(['message' => "service {$service_id} is completed"], 200);
        } else {
            return response()->json(['errors' => 'you are not allowed to perform this action'], 400);
        }
    }




    public function showProductOrders()
    {
        $id = Auth::user()->id;
        $name = Auth::user()->enginner_name;
        $orders = Order::where('provider_id', $id)->where('order_type', 2)->with('comment', 'providerCancel.reason', 'client')->get();
        return response()->json(["orders" => $orders], 200);
    }


    public function acceptOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order->status == 0) {
            $order->status = $this->orderStatus[0];
            $order->save();
            return response()->json(['message' => "order {$order_id} is accepted "], 200);
        } else {
            return response()->json(['errors' => 'you are not allowed to perform this action'], 400);
        }
    }

    public function isPrepared($order_id)
    {
        $auth=Auth::user()->enginner_name;
        $order = Order::find($order_id);
        if ($order->status == $this->orderStatus[0]) {
            $order->status = $this->orderStatus[1];
            $order->save();
            SendNotificationController::sendNotification(
                $order->client_id,
                1,
                $order->id,
                $order->order_type,
                ' الطلب  جاهز للاستلام',
                "طلبك رقم {$order->id} جاهز للاستلام من قبل {$auth}",
                " order is prepared",
                " your order {$order->id} is prepared by {$auth}"
            );
            return response()->json(['message' => "order {$order_id} is prepared "], 200);
        } else {
            return response()->json(['errors' => 'you are not allowed to perform this action'], 400);
        }
    }

    public function isDeliverd($order_id)
    {
        $auth=Auth::user()->enginner_name;
        $order = Order::find($order_id);
        if ($order->status == $this->orderStatus[1]) {
            $order->status = $this->orderStatus[2];
            $order->save();
            SendNotificationController::sendNotification(
                $order->client_id,
                1,
                $order->id,
                $order->order_type,
                ' الطلب تم تسليمه',
                "طلبك رقم {$order->id} تم تسليمه من قبل {$auth}",
                " order is deliverd",
                " your order {$order->id} is delivered by {$auth}"
            );
            return response()->json(['message' => "order {$order_id} is deliverd and completed "], 200);
        } else {
            return response()->json(['errors' => 'you are not allowed to perform this action'], 400);
        }
    }
}
