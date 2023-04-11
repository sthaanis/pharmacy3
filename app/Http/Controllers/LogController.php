<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __construct(){
        $this->middleware('auth:log');
    }
    public function index(){
        return view('log.index');
    }
}
