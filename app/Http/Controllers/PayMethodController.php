<?php

namespace App\Http\Controllers;

use App\Models\PayMethod;
use Illuminate\Http\Request;

class PayMethodController extends Controller
{
    public function index()
    {
        $payMethods = PayMethod::all();
        return view('paymethods.index', compact('payMethods'));
    }

    public function show(int $id)
    {
        $payMethod = PayMethod::find($id);
        return view('paymethods.show', compact('payMethod'));
    }

    public function create()
    {
        return view('paymethods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        PayMethod::create($request->all());
        return redirect()->route('paymethods.index')->with('success', 'Payment method created successfully.');
    }

    public function edit(int $id)
    {
        $payMethod = PayMethod::find($id);
        return view('paymethods.edit', compact('payMethod'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $payMethod = PayMethod::find($id);
        $payMethod->name = $request->name;
        $payMethod->save();

        return redirect()->route('paymethods.index')->with('success', 'Payment method updated successfully.');
    }

    public function destroy(int $id)
    {
        PayMethod::destroy($id);
        return redirect()->route('paymethods.index')->with('success', 'Payment method deleted successfully.');
    }
}
