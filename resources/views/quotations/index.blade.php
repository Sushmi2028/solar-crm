@extends('layouts.app')

@section('content')

<div class="card-box">

    <div class="d-flex justify-content-between mb-3">
        <h5>Quotations</h5>
        <a href="/quotations/create" class="btn btn-primary btn-sm">+ New Quote</a>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Customer</th>
                <th>System</th>
                <th>Base</th>
                <th>Tax</th>
                <th>Final</th>
                <th>Status</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($quotes as $q)
        <tr>
            <td>{{ $q->customer_id }}</td>
            <td>{{ $q->system_size }}</td>
            <td>₹{{ $q->base_price }}</td>
            <td>₹{{ $q->tax }}</td>
            <td><b>₹{{ $q->final_price }}</b></td>
            <td>
                <span class="badge bg-warning">{{ $q->status }}</span>
            </td>
            <td class="text-end">
                <a href="/orders/confirm/{{ $q->id }}" class="btn btn-success btn-sm">
                    Confirm
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

</div>

@endsection