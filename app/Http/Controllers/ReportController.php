<?php

namespace App\Http\Controllers;

use Countries;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $countries = Countries::pluck('id', 'name');
        $currencies = Countries::pluck('currency_code');
        return view('reports.create')->with(compact('countries', 'currencies'));
    }
}
