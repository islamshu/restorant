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
    public function all_data(){
        $res =[
            'website_title'=>get_general_value('title'),
            'logo'=>asset('uploads/'.get_general_value('image')),
            'background'=>asset('uploads/'.get_general_value('background')),
            'background_watting'=>asset('uploads/'.get_general_value('background_wishlist')),
            'first_welcom_content'=>get_general_value('welcom_first'),
            'secand_welcom_content'=>get_general_value('welcom_secand'),
            'menu_url'=>get_general_value('menu_url'),
            'map'=>get_general_value('map'),
            'phone_number'=>get_general_value('phone_number'),
            'facebook'=>get_general_value('facebook'),
            'whatsapp'=>get_general_value('whatsapp'),
            'instagram'=>get_general_value('instagram'),
            'email'=>get_general_value('email'),
            'start_at'=>get_general_value('start_at'),
            'end_at'=>get_general_value('end_at'),
            'background_closed'=>get_general_value('background_closed'),
            'is_open'=>get_general_value('is_open'),
            'close_message'=>get_general_value('close_message')
        ];
        return $this->sendResponse($res,'all response');
    }
}

