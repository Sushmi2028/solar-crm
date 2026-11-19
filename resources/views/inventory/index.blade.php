@extends('layouts.app')
@section('content')

<h4 class="mb-4 fw-bold">Inventory Dashboard</h4>

<!-- SUMMARY CARDS -->
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card card-blue">
            <h6>Total Products</h6>
            <h3>{{ $products->count() }}</h3>
            <i class="fa fa-box"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card card-green">
            <h6>Total Stock</h6>
            <h3>{{ $products->sum('stock') }}</h3>
            <i class="fa fa-warehouse"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card card-orange">
            <h6>Low Stock</h6>
            <h3>{{ $lowStock->count() }}</h3>
            <i class="fa fa-triangle-exclamation"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card card-purple">
            <h6>Categories</h6>
            <h3>{{ $products->pluck('category')->unique()->count() }}</h3>
            <i class="fa fa-layer-group"></i>
        </div>
    </div>
</div>

<!-- LOW STOCK ALERT -->
@if($lowStock->count())
<div class="alert alert-danger shadow-sm border-0 mb-4">
    <h6 class="fw-bold mb-2">
        <i class="fa fa-triangle-exclamation me-2"></i>
        Low Stock Alert
    </h6>

    @foreach($lowStock as $item)
        <span class="badge bg-danger me-2">
            {{ $item->name }}
        </span>
    @endforeach
</div>
@endif

<!-- INVENTORY TABLE -->
<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Product Inventory</h5>
            <div>
                <a href="/inventory/export/csv"class="btn btn-light btn-sm me-2">
                    <i class="fa fa-file-csv"></i> CSV
                </a>

                <a href="/inventory/export/pdf"
                   class="btn btn-danger btn-sm">
                    <i class="fa fa-file-pdf"></i> PDF
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Min Stock</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($products as $p)
                <tr>
                    <td><strong>{{ $p->name }}</strong></td>

                    <td>{{ $p->category }}</td>

                    <td>
                        <span class="badge {{ $p->stock <= $p->min_stock ? 'bg-danger' : 'bg-success' }}">{{ $p->stock }}</span>
                    </td>

                    <td>{{ $p->min_stock }}</td>

                    <td class="text-end">
                        <button type="button"class="btn btn-success btn-sm me-1"data-bs-toggle="modal"data-bs-target="#inModal{{ $p->id }}">
                            <i class="fa fa-plus"></i> In
                        </button>

                        <button type="button"class="btn btn-danger btn-sm"data-bs-toggle="modal"data-bs-target="#outModal{{ $p->id }}">
                            <i class="fa fa-minus"></i> Out
                        </button>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="5" class="text-center">No products found</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODALS -->
@foreach($products as $p)
<div class="modal fade" id="inModal{{ $p->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="/stock/in">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Stock - {{ $p->name }}</h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                    <input type="number" name="quantity" class="form-control mb-3" placeholder="Enter quantity" required>
                    <input type="text" name="remarks" class="form-control" placeholder="Remarks">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Add Stock</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="outModal{{ $p->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="/stock/out">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Remove Stock - {{ $p->name }}</h5>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                    <input type="number" name="quantity" class="form-control mb-3" placeholder="Enter quantity" required>
                    <input type="text" name="remarks" class="form-control" placeholder="Remarks">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger">Remove Stock</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- CHART -->
<div class="card border-0 shadow-lg mt-4">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Stock Analysis</h5>
    </div>

    <div class="card-body">
        <canvas id="inventoryChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = @json($chartLabels);
const stockData = @json($chartStock);
const usageData = @json($chartUsage);

new Chart(document.getElementById('inventoryChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Stock Available',
                data: stockData
            },
            {
                label: 'Usage',
                data: usageData
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endsection