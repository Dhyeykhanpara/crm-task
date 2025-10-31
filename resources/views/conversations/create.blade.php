@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Add Conversation</h3>

    {{--Server-side validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="conversationForm" method="POST" action="{{ route('conversations.store') }}">
        @csrf

        {{--Customer Dropdown --}}
        <div class="mb-3">
            <label class="form-label">Customer</label>
            <select name="customer_id" id="customer_id" class="form-select">
                <option value="">Select Customer</option>
                @foreach($customers as $cust)
                    @if($cust->status !== 'Inactive')
                        <option value="{{ $cust->id }}" @selected(request('customer') == $cust->id)>
                            {{ $cust->name }} ({{ $cust->status }})
                        </option>
                    @endif
                @endforeach
            </select>
            <div class="invalid-feedback">Please select a customer.</div>
            @error('customer_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{--Medium --}}
        <div class="mb-3">
            <label class="form-label">Medium</label>
            <select name="medium" id="medium" class="form-select">
                <option value="">Select Medium</option>
                <option value="Call">Call</option>
                <option value="Email">Email</option>
                <option value="SMS">SMS</option>
                <option value="Other">Other</option>
            </select>
            <div class="invalid-feedback">Please select a communication medium.</div>
            @error('medium') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{--Time --}}
        <div class="mb-3">
            <label class="form-label">Time</label>
            <input type="datetime-local" name="time" id="time" class="form-control" value="{{ old('time') }}">
            <div class="invalid-feedback">Please select a valid date and time.</div>
            @error('time') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{--Message / Notes --}}
        <div class="mb-3">
            <label class="form-label">Message / Notes</label>
            <textarea name="message" id="message" class="form-control" rows="3">{{ old('message') }}</textarea>
            <div class="invalid-feedback">Please enter a short message or notes.</div>
            @error('message') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('conversations.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

{{--Client-side validation --}}
<script>
document.getElementById('conversationForm').addEventListener('submit', function (e) {
    let isValid = true;

    const customer = document.getElementById('customer_id');
    const medium = document.getElementById('medium');
    const time = document.getElementById('time');
    const message = document.getElementById('message');

    // Reset all invalid states
    [customer, medium, time, message].forEach(field => field.classList.remove('is-invalid'));

    // Validate Customer
    if (!customer.value.trim()) {
        customer.classList.add('is-invalid');
        isValid = false;
    }

    // Validate Medium
    if (!medium.value.trim()) {
        medium.classList.add('is-invalid');
        isValid = false;
    }

    // Validate Time
    if (!time.value.trim()) {
        time.classList.add('is-invalid');
        isValid = false;
    }

    // Validate Message / Notes
    if (!message.value.trim()) {
        message.classList.add('is-invalid');
        isValid = false;
    }

    // Stop submission if invalid
    if (!isValid) {
        e.preventDefault();
    }
});
</script>
@endsection
