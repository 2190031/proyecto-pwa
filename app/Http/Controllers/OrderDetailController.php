<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        return OrderDetail::all();
    }

    public function store(Request $request)
    {
        return OrderDetail::create($request->all());
    }
}
