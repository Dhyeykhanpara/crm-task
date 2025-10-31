<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function showForm()
    {
        $customers = Customer::all();
        return view('messages.send', compact('customers'));
    }

    public function send(Request $r)
    {
        // Step 1: Validate input
        $r->validate([
            'message' => 'required|string|max:500',
            'selected' => 'nullable|array'
        ], [
            'message.required' => 'Please enter a message before sending.'
        ]);

        // Step 2: Fetch customers (only active ones)
        $targets = $r->selected
            ? Customer::whereIn('id', $r->selected)->where('status', '!=', 'Inactive')->get()
            : Customer::where('status', '!=', 'Inactive')->get();

        // Step 3: Handle if no active customers found
        if ($targets->isEmpty()) {
            return back()->with('error', 'No active customers selected or all selected customers are inactive.');
        }

        // Step 4: Prepare success messages
        $sentMessages = [];
        foreach ($targets as $customer) {
            $sentMessages[] = "✅ Message sent to {$customer->name} ({$customer->email})";
        }

        // Step 5: Return feedback to the user
        return back()->with('success', implode('<br>', $sentMessages));
    }


}