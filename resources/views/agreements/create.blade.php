@extends('layouts.app')

@section('content')

<div class="card-box">
    <h5>Upload Agreement</h5>

    <form method="POST" action="/agreements/store" enctype="multipart/form-data">
        @csrf

        <select name="customer_id" class="form-control mb-3">
            @foreach($customers as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>

        <select name="order_id" class="form-control mb-3">
            @foreach($orders as $o)
                <option value="{{ $o->id }}">Order #{{ $o->id }}</option>
            @endforeach
        </select>

        <input type="file" name="file" class="form-control mb-3">

        <button class="btn btn-success btn-sm">Upload</button>

    </form>
</div>
@endsection