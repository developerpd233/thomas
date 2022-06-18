<?php

//namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IPN_Simulator extends Controller
{
    public function index()
    {
        return view('IPN_Simulator');
    }
}