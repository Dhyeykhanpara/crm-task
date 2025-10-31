@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Conversations</h3>
        <a href="{{ route('conversations.create') }}" class="btn btn-primary btn-sm">+ Add Conversation</a>
    </div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    @if($conversations->count())
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr><th>#</th><th>Customer</th><th>Medium</th><th>Time</th><th>Message</th></tr>
            </thead>
            <tbody>
                @foreach($conversations as $conv)
                    <tr>
                        <td>{{ $conv->id }}</td>
                        <td>{{ $conv->customer->name ?? '-' }}</td>
                        <td>{{ $conv->medium }}</td>
                        <td>{{ \Carbon\Carbon::parse($conv->time)->format('Y-m-d H:i') }}</td>
                        <td>{{ $conv->message }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">No conversations recorded.</div>
    @endif
</div>
@endsection
