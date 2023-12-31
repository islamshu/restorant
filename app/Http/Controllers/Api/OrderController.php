<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\TimeRestorant;
use App\Models\User;
use App\Notifications\OrderAdded;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Pusher\Pusher;

class OrderController extends BaseController
{
    public function make_order(Request $request){
        $checkOrder = Order::where('phone',$request->phone)->where('status',2)->first();
        if($checkOrder){
            $queue = Order::where('status',2)->where('id', '<', $checkOrder->id)->count();
            return $this->sendErrorTest("يوجد لديك حجز حالي على الدور ورقمه  ".$queue);
        }
        $order = new Order();
        $order->code  = date('Ymd-His').rand(10,99);
        $order->name = $request->name;
        $order->guest = $request->guest;
        $order->phone = $request->phone;
        $order->note = $request->note;
        // $order->table_type = $request->table_type;
        // $order->place_type = $request->place_type;
        $order->status = 2;
        $order->save();
        $res = new OrderResource($order);
        $user = User::first();
        $pusher = new Pusher('ecfcb8c328a3a23a2978', '6f6d4e2b81650b704aba', '1534721', [
            'cluster' => 'ap2',
            'useTLS' => true
        ]);
        $date_send = [
            'id' => $order->id,
        ];
        $pusher->trigger('notifications', 'new-notification', $date_send);
       
        $notification = new OrderAdded($order);
        Notification::send($user, $notification);

        // return response()->json(['message' => 'Item added to cart']);
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
            'menu_url'=>get_general_value('menu'),
            'map'=>get_general_value('map'),
            'phone_number'=>get_general_value('phone_number'),
            'facebook'=>get_general_value('facebook'),
            'whatsapp'=>get_general_value('whatsapp'),
            'instagram'=>get_general_value('instagram'),
            'email'=>get_general_value('email'),
            'start_at'=>get_general_value('start_at'),
            'end_at'=>get_general_value('end_at'),
            'background_closed'=>asset('uploads/'.get_general_value('background_closed')),
            'is_open'=> if_is_open('is_open') ,
            'close_message'=>get_general_value('close_message'),
            'close_message_en'=>get_general_value('close_message_en'),
            'max_order'=>get_general_value('max_order'),
            'close_max_message'=>get_general_value('close_max_message'),
            'close_max_message_en'=>get_general_value('close_max_message_en'),
            'manual_close_message_en'=>get_general_value('manual_close_message_en'),
            'manual_close_message'=>get_general_value('manual_close_message'),
            'is_manual_close'=>get_general_value('is_manual_close'),
            'is_emergency_close'=>get_general_value('is_emergency_close'),
            'emergency_close_message'=>get_general_value('emergency_close_message'),
            'emergency_close_message_en'=>get_general_value('emergency_close_message_en'),
            'now_queue'=>Order::where('status',2)->count(),
            'start_at_new'=>Carbon::createFromFormat('H:i:s', TimeRestorant::first()->start_at)->format('h:i A'),
            'end_at_new'=>Carbon::createFromFormat('H:i:s', TimeRestorant::first()->end_at)->format('h:i A'),


        ];
        return $this->sendResponse($res,'all response');
    }
    public function resend_request($order_id){
        $order = Order::where('code',$order_id)->first();
        // $order = Order::findOrFail($orderId);

        // Get the last order ID from the database
        $lastOrderId = Order::orderByDesc('id')->value('id');

        // Update the ID of the order to be the last order ID + 1
        $order->id = $lastOrderId + 1;
        $order->save();
        $res = new OrderResource($order);
        $user = User::first();
        $pusher = new Pusher('ecfcb8c328a3a23a2978', '6f6d4e2b81650b704aba', '1534721', [
            'cluster' => 'ap2',
            'useTLS' => true
        ]);
        $date_send = [
            'id' => $order->id,
        ];
        $pusher->trigger('notifications', 'new-notification', $date_send);
       
        $notification = new OrderAdded($order);
        Notification::send($user, $notification);
        return response()->json(['status' => 'success']);

    }
    public function get_status($id){
        $order = Order::where('code',$id)->first();
        $res = $order->status;
        $queue = Order::where('status',2)->where('id', '<', $order->id)->count();
        return response()->json(['status' => $order->status ,'number_queue'=>$queue,'user_name'=>$order->name]);
    }
    
}

