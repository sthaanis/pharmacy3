<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use Auth;

class PharmController extends Controller
{
    public function __construct(){
        $this->middleware('auth:pharm');
    }
    public function index(){
        return view('pharm.index');
    }

    public function prescription(){
        $prescription = Prescription::all();
        return view('pharm.presc',['prescriptions'=>$prescription]);
    }

    public function approvePrescription(Request $request, $id){
        $presc = prescription::find($id);
        $presc->status = 'approved';
        $presc->pharmacist_id = Auth::user()->id;
        $presc->save();
        return redirect()->back();
    }
}
