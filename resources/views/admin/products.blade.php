@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Product Management</h4>
</div>

<!-- SUMMARY CARDS -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="summary-card gradient-blue">
            <h6>Total Products</h6>
            <h2>{{ count($products) }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="summary-card gradient-green">
            <h6>Active Products</h6>
            <h2>{{ $products->where('status','Active')->count() }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="summary-card gradient-orange">
            <h6>Categories</h6>
            <h2>{{ $products->pluck('category')->unique()->count() }}</h2>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- ADD PRODUCT -->
    <div class="col-lg-4">
        <div class="card-box p-4">
            <h5 class="fw-bold mb-3">Add Product</h5>

            <form method="POST" action="/admin/products/store">
                @csrf
                <input type="text"name="name"class="form-control mb-3"placeholder="Product Name"required>

                <select name="category"class="form-control mb-3"required>
                    <option value="">Select Category</option>
                    <option value="Panel">Panel</option>
                    <option value="Inverter">Inverter</option>
                    <option value="Battery">Battery</option>
                    <option value="Structure">Structure</option>
                </select>

                <input type="number"name="price"class="form-control mb-3"placeholder="Price"required>

                <input type="text"name="capacity"class="form-control mb-3"placeholder="Capacity (e.g. 5kW)">

                <input type="number"name="subsidy"class="form-control mb-3"placeholder="Subsidy %">

                <select name="status"class="form-control mb-3">
                    <option>Active</option>
                    <option>Inactive</option>
                </select>

                <textarea name="description"rows="4"class="form-control mb-4"placeholder="Description"></textarea>

                <div class="d-grid">
                    <button class="btn btn-success">
                        <i class="fa fa-plus-circle me-1"></i>Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- PRODUCT LIST -->
    <div class="col-lg-8">
        <div class="card-box p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">All Products</h5>
                <span class="badge bg-primary">{{ count($products) }} Products</span>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Capacity</th>
                            <th>Price</th>
                            <th>Subsidy</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($products as $p)
                    <tr>
                        <td class="fw-semibold">
                            {{ $p->name }}
                        </td>

                        <td>
                            {{ $p->category }}
                        </td>

                        <td>
                            {{ $p->capacity }}
                        </td>

                        <td class="fw-bold text-success">
                            ₹{{ number_format($p->price,2) }}
                        </td>

                        <td>
                            {{ $p->subsidy }}%
                        </td>

                        <td>
                            <span class="badge {{ $p->status=='Active' ? 'bg-success' : 'bg-danger' }}">
                                {{ $p->status }}
                            </span>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            No products found
                        </td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection