<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Manage_TransferController extends Controller
{
    public function index(){
        return view('WMS.Manage_transfer.index');
    }
    public function create(){
        return view('WMS.Manage_transfer.create');
    }
}
