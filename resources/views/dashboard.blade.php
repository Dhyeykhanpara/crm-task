@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="mb-4">Welcome, {{ auth()->user()->name }}</h1>
    <p class="mb-4">Use the buttons below to manage your CRM system.</p>

    <a href="{{ route('customers.index') }}" class="btn btn-primary btn-lg me-2">Manage Customers</a>
    <a href="{{ route('conversations.index') }}" class="btn btn-secondary btn-lg me-2">View Conversations</a>
    <a href="{{ route('messages.form') }}" class="btn btn-success btn-lg">Send Message</a>
</div>
@endsection
