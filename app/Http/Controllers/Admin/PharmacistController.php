<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pharmacist;

class PharmacistController extends Controller
{
    public function index(){
        $pharmacist = Pharmacist::all();
        return view('admin.pharmacist.list',['pharmacists'=>$pharmacist]);
    }

    public function new(){
        return view('admin.pharmacist.new');
    }

    public function save(Request $request){
        $pharmacist = new Pharmacist();
        $pharmacist->name = $request->get('name');
        $pharmacist->email = $request->get('email');
        $pharmacist->contact_no = $request->get('contact_no');
        $pharmacist->address = $request->get('address');
        $pharmacist->password = $request->get('password');
        $pharmacist->position = $request->get('position');
        $pharmacist->save();
        return redirect()->route('pharmacy.admin.pharmacist.index');
    }
}
