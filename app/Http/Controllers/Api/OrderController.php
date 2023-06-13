<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController extends BaseController
{
    public function make_order(Request $request){
        $order = new Order();
        $order->code  = date('Ymd-His').rand(10,99);
        $order->name = $request->name;
        $order->guest = $request->guest;
        $order->phone = $request->phone;
        $order->note = $request->note;
        $order->table_type = $request->table_type;
        $order->place_type = $request->place_type;
        $order->status = 2;
        $order->save();
        $res = new OrderResource($order);
        return $this->sendResponse($res,'تم ارسال الطلب بنجاح');


    }
}
