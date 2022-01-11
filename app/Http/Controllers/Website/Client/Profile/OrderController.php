<?php

namespace App\Http\Controllers\Website\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SendNotificationController;
use App\Http\Requests\StoreCommentForProvider;
use App\Models\CancellationReasons;
use App\Models\Client;
use App\Models\ClientCancellation;
use App\Models\CommentAndRate;
use App\Models\More;
use App\Models\Order;
use App\Models\OrderPrice;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public $orderStatus = [1, 2, 3, 4, 5];
    //1->قيد التنفيذ
    //2->تم التجهيز
    //3->تم التسليم
    //4->مكتمله
    //5->ملغاه
    private function operation($order)
    {
        $total_price = 0;
        foreach ($order->product as $pro) {

            $total_price = $total_price + $pro->pivot->total_price;
        }
        $commession = More::all('commission', 'id')->first();
        $commession_price = ($commession['commission'] / 100) * $total_price;
        $final_price = $total_price + $commession_price;
        return array('total_price' => $total_price, 'commession' => $commession, 'commession_price' => $commession_price, 'final_price' => $final_price);
    }

    public function orderIndex()
    {
        $orders = Order::all();
        $id = Auth::user()->id;
        $productOrders = Order::where('order_type', 2)->where('client_id', $id)->get();
        $publicOrders = Order::where('order_type', 0)->where('client_id', $id)->get();
        $privateOrders = Order::where('order_type', 1)->where('client_id', $id)->get();
        return view(
            'website.client.profile.orders.index',
            [
                'productOrders' => $productOrders, 'publicOrders' => $publicOrders, 'privateOrders' => $privateOrders
            ]
        );
    }

    //product order

    public function showProductOrderNew($order_id)
    {
        $rate = ['one', 'two', 'three', 'four', 'five'];
        $id = Auth::user()->id;
        $client = Client::find($id);
        $order = Order::find($order_id);
        $cancellationReasons = CancellationReasons::all();
        if ($client->clientHasOrder($order_id) && ($order->status == 0)) {

            $data = $this->operation($order);
            return view('website.client.profile.orders.product.newShow', ['cancellationReasons' => $cancellationReasons, 'rate' => $rate, 'order' => $order, 'total_price' => $data['total_price'], 'commession' => $data['commession'], 'commession_price' => $data['commession_price'], 'final_price' => $data['final_price']]);
        } else {
            return "no";
            //comment;
        }
    }
    public function showProductOrderNow($order_id)
    {
        $rate = ['one', 'two', 'three', 'four', 'five'];
        $id = Auth::user()->id;
        $client = Client::find($id);
        $order = Order::find($order_id);
        if ($client->clientHasOrder($order_id)) {

            $data = $this->operation($order);
            return view('website.client.profile.orders.product.nowShow', ['rate' => $rate, 'order' => $order, 'total_price' => $data['total_price'], 'commession' => $data['commession'], 'commession_price' => $data['commession_price'], 'final_price' => $data['final_price']]);
        } else {
            return "no";
        }
    }

    public function addCommentToProvider(StoreCommentForProvider $request)
    {
        $auth = Auth::user()->name;
        $validatedData = $request->validated();
        $comment = new CommentAndRate;
        $comment->fill($validatedData);
        $comment->client_id = Auth::user()->id;
        $comment->save();
        $allCommentsAvg = CommentAndRate::where('provider_id', $validatedData['provider_id'])->avg('rate');
        $provider = Provider::find($validatedData['provider_id']);
        $provider->rate = $allCommentsAvg;
        $provider->save();
        $order = Order::find($validatedData['order_id']);
        $order->status = 4;
        $order->save();

        SendNotificationController::sendNotification(
            $order->provider_id,
            0,
            $order->id,
            $order->order_type,
            ' لديك تعليق',
            "قام {$auth} بالتعليق على الخدمة الخاصة بك رقم {$order->id}",
            "you have new comment",
            "{$auth} commeted on your service {$order->id}"
        );
        return response()->json(['status' => true, 'result' => 'Success']);
    }

    public function showProductOrderComplete($order_id)
    {
        $rate = ['one', 'two', 'three', 'four', 'five'];
        $id = Auth::user()->id;
        $client = Client::find($id);
        $order = Order::find($order_id);
        if ($client->clientHasOrder($order_id)) {

            $data = $this->operation($order);
            return view('website.client.profile.orders.product.completeShow', ['rate' => $rate, 'order' => $order, 'total_price' => $data['total_price'], 'commession' => $data['commession'], 'commession_price' => $data['commession_price'], 'final_price' => $data['final_price']]);
        } else {
            return "no";
        }
    }

    public function showProductOrderCancel($order_id)
    {
        $rate = ['one', 'two', 'three', 'four', 'five'];
        $id = Auth::user()->id;
        $client = Client::find($id);
        $order = Order::find($order_id);
        if ($client->clientHasOrder($order_id)) {

            $data = $this->operation($order);
            return view('website.client.profile.orders.product.cancelShow', ['rate' => $rate, 'order' => $order, 'total_price' => $data['total_price'], 'commession' => $data['commession'], 'commession_price' => $data['commession_price'], 'final_price' => $data['final_price']]);
        } else {
            return "no";
        }
    }

    public function postClientCancel(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required',
            'cancel_id' => 'required',
        ]);

        $order = Order::find($data['order_id']);
        if ($order->status == 0 && $order->client_id == Auth::user()->id) {
            $cancel = new ClientCancellation;
            $cancel->order_id = $data['order_id'];
            $cancel->client_id = Auth::user()->id;
            $cancel->cancel_id = $data['cancel_id'];
            $cancel->save();
            $order->status = $this->orderStatus[4];
            $order->save();
            return response()->json(['status' => true, 'result' => 'Success']);
        } else {
            return "no";
        }
    }


    ///private

    public function showPrivatePublicOrderNew($order_id)
    {
        $rate = ['one', 'two', 'three', 'four', 'five'];
        $id = Auth::user()->id;
        $client = Client::find($id);
        $order = Order::find($order_id);
        $cancellationReasons=CancellationReasons::all();
        if ($client->clientHasOrder($order_id) && ($order->status == 0) && ($order->order_type == 1 || $order->order_type == 0)) {
            return view('website.client.profile.orders.publicPrivate.newShow',['cancellationReasons'=>$cancellationReasons,'rate'=>$rate,'order'=>$order]);
        } else {
            return "no";
        }
    }

    public function acceptPrice(Request $request)
    {
        //  dd($request);
        $auth=Auth::user()->name;
        $price = OrderPrice::where('id', $request->price_id)->where('order_id', $request->order_id)->get()[0];
        // dd($price);
        $order = Order::find($request->order_id);
        OrderPrice::where('id', '!=', $request->price_id)->where('order_id', $request->order_id)->delete();

        if ($order->provider_id == null) {
            $order->provider_id = $price->provider_id;
        }
        $order->status = $this->orderStatus[0];
        $order->save();
        SendNotificationController::sendNotification(
            $order->provider_id,
            0,
            $order->id,
            $order->order_type,
            'قبول عرض السعر',
            "عرض سعرك على طلب رقم {$order->id} تم قبول من قبل {$auth}",
            " price offer accepted",
            " your price offer on order {$order->id} is accepted by {$auth} "
        );
        
        return  redirect()->route('client.orders') ;
    }

    public function refusePrice(Request $request)
    {
        // dd($request);
        $order=Order::find($request->order_id);
        $auth=Auth::user()->name;
        OrderPrice::where('id', $request->price_id)->where('order_id', $request->order_id)->delete();
        SendNotificationController::sendNotification(
            $order->provider_id,
            0,
            $order->id,
            $order->order_type,
            'رفض عرض السعر',
            "عرض سعرك على طلب رقم {$order->id} تم رفض من قبل {$auth}",
            " price offer canceled",
            " your price offer on order {$order->id} is canceled by {$auth} "
        );
        return  redirect()->route('client.orders');
    }

    public function showPrivatePublicOrderNow($order_id){
        $rate = ['one', 'two', 'three', 'four', 'five'];
        $id = Auth::user()->id;
        $client = Client::find($id);
        $order = Order::find($order_id);
        if ($client->clientHasOrder($order_id) && ($order->status ==3||$order->status ==1)  && ($order->order_type == 1||$order->order_type == 0)) {
            return view('website.client.profile.orders.publicPrivate.nowShow',['rate'=>$rate,'order'=>$order]);
        } else {
            return "no";
        }
    }

    public function showPrivatePublicOrderComplete($order_id){

      $rate = ['one', 'two', 'three', 'four', 'five'];
        $id = Auth::user()->id;
        $client = Client::find($id);
        $order = Order::find($order_id);
        if ($client->clientHasOrder($order_id) && ($order->status ==4)  && ($order->order_type == 1 ||$order->order_type == 0)) {
            return view('website.client.profile.orders.publicPrivate.completeShow',['rate'=>$rate,'order'=>$order]);
        } else {
            return "no";
        }
    }

    public function showPrivatePublicOrderCancel($order_id){
        $rate = ['one', 'two', 'three', 'four', 'five'];
        $id = Auth::user()->id;
        $client = Client::find($id);
        $order = Order::find($order_id);
        if ($client->clientHasOrder($order_id) && ($order->status ==5)  && ($order->order_type == 1 ||$order->order_type == 0)) {
            return view('website.client.profile.orders.publicPrivate.cancelShow',['rate'=>$rate,'order'=>$order]);
        } else {
            return "no";
        }
    }



}
