@extends('layouts.app')

@section('content')

<div class="card-box">

    <h5>Agreements</h5>

    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>Customer</th>
                <th>File</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
        @foreach($agreements as $a)
        <tr>
            <td>{{ $a->customer_name }}</td>
            <td>
                <a href="/storage/{{ $a->file }}" target="_blank" class="btn btn-info btn-sm">
                    View
                </a>
            </td>
            <td>
                <span class="badge bg-success">{{ $a->status }}</span>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

</div>

@endsection