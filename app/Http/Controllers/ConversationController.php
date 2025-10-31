<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Customer;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::with('customer')->latest()->get();
        return view('conversations.index', compact('conversations'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('conversations.create', compact('customers'));
    }

    public function store(Request $r)
{
    $r->validate(['customer_id'=>'required','medium'=>'required','time'=>'required']);
    
    $customer = Customer::findOrFail($r->customer_id);
    if ($customer->status === 'Inactive') {
        return back()->with('error', 'Cannot add conversation for inactive customer.');
    }

    Conversation::create($r->only(['customer_id','medium','time','message']));
    return redirect()->route('conversations.index')->with('success','Conversation added');
}

}

