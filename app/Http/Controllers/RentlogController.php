<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentlogController extends Controller
{
    public function index()
    {
        $rentlist = RentLogs::with(['user','book'])->get();
        return view('rent-log',[
            'rentlist' => $rentlist,
        ]);
    }
}
