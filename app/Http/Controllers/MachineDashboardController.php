<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MachineDashboardController extends Controller
{
    public function index(){
        return view('Production.MachineDashboard.index');
    }
}
