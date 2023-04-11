<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;

class OrderController extends Controller
{
    public function index(){
        $order = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.id','orders.order_no', 'orders.quantity', 'orders.status', 'orders.payment_method', 'products.product_name', 'products.mrp', 'products.image', 'users.name','users.contact_number')
            ->get();
        return view('admin.order.list',['orders'=>$order]);
    }

    public function ship(Request $request, $id){
        $order = Order::find($id);
        $order->status = 'ready-to-ship';
        $order->save();
        return redirect()->back();
    }
}
