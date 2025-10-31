<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Exception;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            $customers = Customer::latest()->get();
            return view('customers.index', compact('customers'));
        } catch (Exception $e) {
            Log::error('Error fetching customers: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while fetching customers.');
        }
    }

    public function create()
    {
        try {
            return view('customers.create');
        } catch (Exception $e) {
            Log::error('Error loading create customer form: ' . $e->getMessage());
            return back()->with('error', 'Unable to load the create customer form.');
        }
    }

    public function store(Request $r)
    {
        try {
            $r->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:customers,email',
                'contact' => 'required|string|max:15',
                'status' => 'required|string'
            ]);

            Customer::create($r->only(['name', 'email', 'contact', 'address', 'status']));

            return redirect()->route('customers.index')->with('success', 'Customer added successfully!');
        } 
        catch (ValidationException $e) {
            throw $e; // ✅ Let Laravel show validation errors normally
        } 
        catch (Exception $e) {
            Log::error('Error creating customer: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to add customer. Please try again.');
        }
    }

    public function edit(Customer $customer)
    {
        try {
            return view('customers.edit', compact('customer'));
        } catch (Exception $e) {
            Log::error('Error loading edit form: ' . $e->getMessage());
            return back()->with('error', 'Unable to load edit form.');
        }
    }

    public function update(Request $r, Customer $customer)
    {
        try {
            $r->validate([
                'name' => 'required|string|max:100',
                'email' => "required|email|unique:customers,email,{$customer->id}",
                'contact' => 'required|string|max:15',
                'status' => 'required|string'
            ]);

            $customer->update($r->only(['name', 'email', 'contact', 'address', 'status']));

            return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
        } 
        catch (ValidationException $e) {
            throw $e; // ✅ keeps field errors working
        } 
        catch (Exception $e) {
            Log::error('Error updating customer: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update customer. Please try again.');
        }
    }

    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return back()->with('success', 'Customer deleted successfully!');
        } catch (Exception $e) {
            Log::error('Error deleting customer: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete customer. Please try again later.');
        }
    }
}
