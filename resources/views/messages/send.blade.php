@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Send Message</h3>

    {{-- ✅ Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success">{!! session('success') !!}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{!! session('error') !!}</div>
    @endif

    <form class="needs-validation" novalidate method="POST" action="{{ route('messages.send') }}">
        @csrf

        {{-- ✅ Message input --}}
        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control" required>{{ old('message') }}</textarea>
            @error('message') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        {{-- ✅ Customer selection --}}
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="form-label mb-0">Select Customers (inactive are disabled)</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="selectAllActive">
                    <label class="form-check-label fw-bold text-primary" for="selectAllActive">
                        Select All Active
                    </label>
                </div>
            </div>

            <div class="border p-2" style="max-height: 250px; overflow-y: auto;">
                @foreach($customers as $cust)
                    <div class="form-check mb-1">
                        <input
                            class="form-check-input customer-checkbox"
                            type="checkbox"
                            name="selected[]"
                            value="{{ $cust->id }}"
                            id="cust{{ $cust->id }}"
                            data-status="{{ $cust->status }}"
                            @if($cust->status === 'Inactive') disabled @endif
                        >
                        <label class="form-check-label" for="cust{{ $cust->id }}">
                            {{ $cust->name }} — {{ $cust->email }}
                            @if($cust->status === 'Inactive')
                                <span class="badge bg-secondary ms-2">Inactive</span>
                            @elseif($cust->status === 'Lead')
                                <span class="badge bg-warning ms-2">Lead</span>
                            @else
                                <span class="badge bg-success ms-2">Active</span>
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

{{-- ✅ JavaScript for Select All Active --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const selectAll = document.getElementById('selectAllActive');
    const checkboxes = document.querySelectorAll('.customer-checkbox');

    selectAll.addEventListener('change', function() {
        checkboxes.forEach(box => {
            // Only select active customers (status !== 'Inactive')
            if (box.dataset.status === 'Active' && !box.disabled) {
                box.checked = this.checked;
            }
        });
    });
});
</script>
@endsection
