<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class MessageController extends Controller
{
    public function showForm()
    {
        try {
            $customers = Customer::all();
            return view('messages.send', compact('customers'));
        } catch (Exception $e) {
            Log::error('Error loading message form: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while loading the message form.');
        }
    }

    public function send(Request $r)
    {
        try {
            // Step 1: Validate input
            $r->validate([
                'message' => 'required|string|max:500',
                'selected' => 'nullable|array'
            ], [
                'message.required' => 'Please enter a message before sending.'
            ]);

            // Step 2: Fetch customers (only active)
            $targets = $r->selected
                ? Customer::whereIn('id', $r->selected)->where('status', '!=', 'Inactive')->get()
                : Customer::where('status', '!=', 'Inactive')->get();

            // Step 3: Handle no active customer
            if ($targets->isEmpty()) {
                return back()->with('error', 'No active customers selected or all selected customers are inactive.');
            }

            // Step 4: Simulate message sending (for demo)
            $sentMessages = [];
            foreach ($targets as $customer) {
                // Example placeholder for real message sending
                // Mail::to($customer->email)->send(new CRMMessageMail($r->message));
                $sentMessages[] = "Message sent to {$customer->name} ({$customer->email})";
            }

            //Step 5: Return success feedback
            return back()->with('success', implode('<br>', $sentMessages));

        } catch (Exception $e) {
            Log::error('Error sending messages: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to send messages. Please try again later.');
        }
    }
}
