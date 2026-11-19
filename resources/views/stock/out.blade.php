@extends('layouts.app')

@section('content')

<h4 class="mb-4 fw-bold">Stock Out</h4>

<div class="card-box">
    <form method="POST" action="/stock/out">
        @csrf

        <select name="product_id" class="form-control mb-2" required>
            <option value="">Select Product</option>
            @foreach($products as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </select>

        <input type="number" name="quantity" class="form-control mb-2" placeholder="Quantity" required>

        <input type="text" name="remarks" class="form-control mb-3" placeholder="Remarks">

        <button class="btn btn-danger w-100">Remove Stock</button>
    </form>
</div>

@endsection