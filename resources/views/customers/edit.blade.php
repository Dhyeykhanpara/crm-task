@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Edit Customer</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('customers.update', $customer->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contact</label>
            <input type="text" name="contact" class="form-control" value="{{ old('contact', $customer->contact) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" rows="2">{{ old('address', $customer->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="Lead" {{ old('status', $customer->status)=='Lead' ? 'selected':'' }}>Lead</option>
                <option value="Active" {{ old('status', $customer->status)=='Active' ? 'selected':'' }}>Active</option>
                <option value="Inactive" {{ old('status', $customer->status)=='Inactive' ? 'selected':'' }}>Inactive</option>
            </select>
        </div>

        <div class="text-end">
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
