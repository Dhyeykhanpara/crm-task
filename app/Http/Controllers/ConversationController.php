<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ConversationController extends Controller
{
    public function index()
    {
        try {
            $conversations = Conversation::with('customer')->latest()->get();
            return view('conversations.index', compact('conversations'));
        } catch (Exception $e) {
            Log::error('Error fetching conversations: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while loading conversations.');
        }
    }

    public function create()
    {
        try {
            $customers = Customer::all();
            return view('conversations.create', compact('customers'));
        } catch (Exception $e) {
            Log::error('Error loading conversation form: ' . $e->getMessage());
            return back()->with('error', 'Unable to load conversation creation form.');
        }
    }

    public function store(Request $r)
    {
        try {
            $r->validate([
                'customer_id' => 'required|exists:customers,id',
                'medium'      => 'required|string',
                'time'        => 'required|date',
                'message'     => 'nullable|string'
            ]);

            $customer = Customer::findOrFail($r->customer_id);

            // Prevent conversation for inactive customers
            if ($customer->status === 'Inactive') {
                return back()->with('error', 'Cannot add conversation for an inactive customer.');
            }

            Conversation::create($r->only(['customer_id', 'medium', 'time', 'message']));

            return redirect()->route('conversations.index')
                ->with('success', 'Conversation added successfully!');
        } catch (Exception $e) {
            Log::error('Error adding conversation: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to add conversation. Please try again.');
        }
    }
}
