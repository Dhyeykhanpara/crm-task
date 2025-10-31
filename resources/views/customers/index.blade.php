@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Customers</h3>
        <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm">+ Add Customer</a>
    </div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    @if($customers->count())
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th><th>Name</th><th>Email</th><th>Contact</th><th>Status</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->contact }}</td>
                        <td>
                            <span class="badge 
                                @if($c->status=='Active') bg-success 
                                @elseif($c->status=='Lead') bg-warning 
                                @else bg-secondary @endif">
                                {{ $c->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('customers.edit',$c->id) }}" class="btn btn-sm btn-info">Edit</a>
                            @if($c->status!=='Inactive')
                                <a href="{{ route('conversations.create',['customer'=>$c->id]) }}" class="btn btn-sm btn-secondary">Add Conv</a>
                            @else
                                <button class="btn btn-sm btn-secondary" disabled>Inactive</button>
                            @endif
                            <form action="{{ route('customers.destroy',$c->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this customer?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Del</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">No customers found.</div>
    @endif
</div>
@endsection
