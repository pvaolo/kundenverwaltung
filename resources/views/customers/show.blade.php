@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Customer Details</h1>
    <p><strong>First Name:</strong> {{ $customer->first_name }}</p>
    <p><strong>Last Name:</strong> {{ $customer->last_name }}</p>
    <p><strong>Email:</strong> {{ $customer->email }}</p>
    <p><strong>Phone:</strong> {{ $customer->phone }}</p>
    <p><strong>Street:</strong> {{ $customer->street }}</p>
    <p><strong>Postal Code:</strong> {{ $customer->postal_code }}</p>
    <p><strong>City:</strong> {{ $customer->city }}</p>
    <a href="{{ route('customers.index') }}" class="btn btn-primary">Back to List</a>
</div>
@endsection
