<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PharmController extends Controller
{
    public function __construct(){
        $this->middleware('auth:pharm');
    }
    public function index(){
        return view('pharm.index');
    }
}
