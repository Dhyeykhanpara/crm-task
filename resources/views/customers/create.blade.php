@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Add Customer</h3>

    {{-- ✅ Server-side validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="createCustomerForm" method="POST" action="{{ route('customers.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            <div class="invalid-feedback">Please enter the customer's name.</div>
            @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            <div class="invalid-feedback">Please enter a valid email address.</div>
            @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Contact</label>
            <input type="text" name="contact" id="contact" class="form-control" value="{{ old('contact') }}">
            <div class="invalid-feedback">Please enter a valid contact number (min 6 digits).</div>
            @error('contact') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control" rows="2">{{ old('address') }}</textarea>
            @error('address') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="">Select Status</option>
                <option value="Lead" {{ old('status') == 'Lead' ? 'selected' : '' }}>Lead</option>
                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            <div class="invalid-feedback">Please select a customer status.</div>
            @error('status') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

{{-- Client-side validation --}}
<script>
document.getElementById('createCustomerForm').addEventListener('submit', function (e) {
    let isValid = true;

    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const contact = document.getElementById('contact');
    const status = document.getElementById('status');

    [name, email, contact, status].forEach(field => field.classList.remove('is-invalid'));

    // Name validation
    if (!name.value.trim()) {
        name.classList.add('is-invalid');
        isValid = false;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim() || !emailRegex.test(email.value)) {
        email.classList.add('is-invalid');
        isValid = false;
    }

    // Contact validation
    if (!contact.value.trim() || contact.value.length < 6) {
        contact.classList.add('is-invalid');
        isValid = false;
    }

    // Status validation
    if (!status.value.trim()) {
        status.classList.add('is-invalid');
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault(); // Stop submission if invalid
    }
});
</script>
@endsection
