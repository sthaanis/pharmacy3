<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistic;

class LogisticController extends Controller
{
    public function index(){
        $logistic = Logistic::all();
        return view('admin.logistic.list',['logistics'=>$logistic]);
    }

    public function new(){
        return view('admin.logistic.new');
    }

    public function save(Request $request){
        $logistic = new Logistic();
        $logistic->name = $request->get('name');
        $logistic->email = $request->get('email');
        $logistic->contact_no = $request->get('contact_no');
        $logistic->address = $request->get('address');
        $logistic->password = $request->get('password');
        $logistic->save();
        return redirect()->route('pharmacy.admin.logistic.index');
    }
}
