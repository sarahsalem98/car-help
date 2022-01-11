<?php

namespace App\Http\Controllers\Website\Provider\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePriceForPublicPrivaterders;
use App\Models\CancellationReasons;
use App\Models\Order;
use App\Models\OrderPrice;
use App\Models\ProviderCancellation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicPrivateController extends Controller
{
    public $orderStatus = [1, 2, 3, 4, 5];

    public function showPublicePrivateOrders()
    {
        $id = Auth::user()->id;
        $publicPrivateOrders = Order::whereIn('order_type', [0, 1])
            ->where('provider_id', $id)
            ->orWhere('provider_id', null)->get();
        // dd($publicPrivateOrders);
        return view('website.provider.order.publicPrivate.index', ['public_private_orders' => $publicPrivateOrders]);
    }
    public function showPublicPrivateNewOrder($servic_id)
    {
        $service = Order::find($servic_id);
        $cacellationReasons = CancellationReasons::all();
        return view('website.provider.order.publicPrivate.newShow', ['service' => $service, 'cacellationReasons' => $cacellationReasons]);
    }


    public function sendPrice(StorePriceForPublicPrivaterders $request)
    {
        $validatedData = $request->validated();
        $price = new OrderPrice;
        $price->fill($validatedData);
        $price->save();
        return redirect()->back()->with('message', trans('success.price_sent'));
    }



    public function sendCancelReasons(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required',
            'cancel_id' => 'required',
        ]);
        // dd($request);

        $order = Order::find($data['order_id']);
        if ($order->status == 0 && $order->provider_id == Auth::user()->id) {
            $cancel = new ProviderCancellation;
            $cancel->order_id = $data['order_id'];
            $cancel->provider_id = Auth::user()->id;
            $cancel->cancel_id = $data['cancel_id'];
            $cancel->save();
            $order->status = $this->orderStatus[4];
            $order->save();
            return response()->json(['status' => true, 'result' => 'Success']);
        } else {
            return response()->json(['result' => 'you are not allowed to perform this action']);
        }
    }
    public function showPublicPrivateNowOrder($servic_id)
    {
        $service = Order::find($servic_id);
        return view('website.provider.order.publicPrivate.nowShow', ['service' => $service]);
    }
    public function acceptService(Request $request)
    {
        // dd($request);
        $service = Order::find($request->service_id);
        $service->status =3;
        $service->save();
        return response()->json(['status' => true, 'result' => 'Success']);
    }

    public function showPublicPrivateCompleteOrder($servic_id)
    {
        $rate = ['one', 'two', 'three', 'four', 'five'];
        $service = Order::find($servic_id);
        return view('website.provider.order.publicPrivate.completeShow', ['service' => $service, 'rate' => $rate]);
    }
    public function showPublicPrivateCancelOrder($servic_id)
    {
        $service = Order::find($servic_id);
        return view('website.provider.order.publicPrivate.cancelShow', ['service' => $service]);
    }


}
