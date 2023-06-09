<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use DB;

class LogController extends Controller
{
    public function __construct(){
        $this->middleware('auth:log');
    }
    public function index(){
        return view('log.index');
    }

    public function order(){
        $order = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('orders.status','!=','pending')
            ->select('orders.id','orders.order_no', 'orders.quantity', 'orders.status', 'orders.payment_method', 'products.product_name', 'products.mrp', 'products.image', 'users.name','users.contact_number')
            ->get();
        return view('log.order',['orders'=>$order]);
    }

    public function deliver(Request $request, $id){
        $order = Order::find($id);
        $order->status = 'delivered';
        $order->save();
        return redirect()->back();
    }
}
