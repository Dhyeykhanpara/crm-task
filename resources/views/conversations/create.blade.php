@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add Conversation</h3>

    <form class="needs-validation" novalidate method="POST" action="{{ route('conversations.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Customer</label>
            <select name="customer_id" class="form-select">
                @foreach($customers as $cust)
                    @if($cust->status!=='Inactive')
                        <option value="{{ $cust->id }}" @selected(request('customer')==$cust->id)>
                            {{ $cust->name }} ({{ $cust->status }})
                        </option>
                    @endif
                @endforeach
            </select>
            @error('customer_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Medium</label>
            <select name="medium" class="form-select">
                <option value="Call">Call</option><option value="Email">Email</option>
                <option value="SMS">SMS</option><option value="Other">Other</option>
            </select>
            @error('medium') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Time</label>
            <input type="datetime-local" name="time" class="form-control" value="{{ old('time') }}">
            @error('time') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Message / Notes</label>
            <textarea name="message" class="form-control">{{ old('message') }}</textarea>
            @error('message') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="text-end">
            <button class="btn btn-success">Save</button>
            <a href="{{ route('conversations.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
