@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between mb-4">
    <h4 class="fw-bold">New Quote</h4>
    <a href="/quotations" class="btn btn-dark"><i class="fa fa-arrow-left me-1"></i>Back</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card-box p-4">
    <form method="POST" action="/quotations/store">
        @csrf

        <!-- Customer -->
        <div class="mb-3">
            <label class="form-label">Customer</label>

            <select name="customer_id" class="form-control"required>
                <option value="">Select Customer</option>

                @foreach($customers as $c)
                <option value="{{ $c->id }}">
                    {{ $c->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Survey -->
        <div class="mb-3">
            <label class="form-label">Site Survey</label>

            <select name="survey_id" class="form-control">
                <option value="">Select Survey</option>

                @foreach($surveys as $s)
                <option value="{{ $s->id }}">
                    Survey #{{ $s->id }} - {{ $s->customer_name }}
                </option>                
                @endforeach
            </select>
        </div>


        <!-- System Size -->
        <div class="mb-3">
            <label class="form-label">System Size</label>
            <input type="text" name="system_size" class="form-control" required>
        </div>

        <!-- Base Price -->
        <div class="mb-3">
            <label class="form-label">Base Price</label>
            <input type="number" id="base_price" name="base_price" class="form-control" oninput="calcQuote()"required>
        </div>

        <!-- Tax -->
        <div class="mb-3">
            <label class="form-label">Tax (18%)</label>
            <input type="text"id="tax"class="form-control"readonly>
        </div>

        <!-- Final Price -->
        <div class="mb-3">
            <label class="form-label">Final Price</label>
            <input type="text" id="final_price" class="form-control" readonly>
        </div>

        <!-- Submit -->
        <button class="btn btn-primary w-100"><i class="fa fa-save me-1"></i>Save Quote</button>
    </form>
</div>

<!-- AUTO TAX CALCULATION -->
<script>
    function calcQuote() {
        let base = parseFloat(
            document.getElementById('base_price').value
        ) || 0;

        let tax = (base * 18) / 100;

        let final = base + tax;

        document.getElementById('tax').value =
            tax.toFixed(2);

        document.getElementById('final_price').value =
            final.toFixed(2);
    }
</script>
@endsection