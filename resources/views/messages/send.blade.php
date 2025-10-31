@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Send Message</h3>

        @if(session('success'))
            <div class="alert alert-success">{!! session('success') !!}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{!! session('error') !!}</div>
        @endif

        <form class="needs-validation" novalidate method="POST" action="{{ route('messages.send') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control">{{ old('message') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Select Customers (inactive are disabled)</label>
                <div class="border p-2" style="max-height:220px;overflow:auto;">
                    @foreach($customers as $cust)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="selected[]" value="{{ $cust->id }}" id="cust{{ $cust->id }}"
                                   @if($cust->status === 'Inactive') disabled @endif>
                            <label class="form-check-label" for="cust{{ $cust->id }}">
                                {{ $cust->name }} — {{ $cust->email }}
                                @if($cust->status === 'Inactive')
                                    <span class="badge bg-secondary ms-2">Inactive</span>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-primary">Send</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection
