<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::latest()->get();
        return view('customers.index', compact('customers'));
    }

    public function create() { return view('customers.create'); }

    public function store(Request $r)
    {
        $r->validate([
            'name'=>'required',
            'email'=>'required|email|unique:customers',
            'contact'=>'required',
            'status'=>'required'
        ]);
        Customer::create($r->only(['name','email','contact','address','status']));
        return redirect()->route('customers.index')->with('success','Customer added');
    }

    public function edit(Customer $customer) { return view('customers.edit', compact('customer')); }

    public function update(Request $r, Customer $customer)
    {
        $r->validate([
            'name'=>'required',
            'email'=>"required|email|unique:customers,email,{$customer->id}",
            'contact'=>'required',
            'status'=>'required'
        ]);
        $customer->update($r->only(['name','email','contact','address','status']));
        return redirect()->route('customers.index')->with('success','Customer updated');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return back()->with('success','Customer deleted');
    }

}
