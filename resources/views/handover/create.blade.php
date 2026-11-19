@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Project Handover</h4>
    <a href="/handover" class="btn btn-dark"><i class="fa fa-arrow-left me-1"></i>Back</a>
</div>

<div class="card-box">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/handover/store" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- CUSTOMER -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Customer</label>
            <select name="customer_id" class="form-control"required>
                <option value="">Select Customer</option>

                @foreach($customers as $c)
                    <option value="{{ $c->id }}">
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- ORDER -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Order</label>
            <select name="order_id" class="form-control"required>
                <option value="">Select Order</option>

                @foreach($orders as $o)
                    <option value="{{ $o->id }}">
                        Order #{{ $o->id }}
                        -
                        {{ $o->customer_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- COMMISSIONING DATE -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Commissioning Date</label>
            <input type="date" name="commissioning_date" class="form-control"required>
        </div>

        <!-- WARRANTY DOCUMENT -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Warranty Document</label>
            <input type="file" name="warranty_document" class="form-control">
            <small class="text-muted">Upload warranty PDF or image</small>
        </div>

        <!-- AMC DOCUMENT -->
        <div class="mb-3">
            <label class="form-label fw-semibold">AMC Document</label>
            <input type="file" name="amc_document" class="form-control">
            <small class="text-muted">Upload AMC agreement file</small>
        </div>

        <!-- TRAINING GIVEN -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Customer Training Given?</label>
            <select name="training_given" class="form-control">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>

        <!-- CUSTOMER TRAINING CHECKLIST -->
        <div class="mb-4">
            <label class="fw-bold mb-3 d-block">Customer Training Checklist</label>
            <!-- SYSTEM DEMO -->
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="system_demo" value="Yes">
                <label class="form-check-label">System Usage Demonstration</label>
            </div>

            <!-- MAINTENANCE -->
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="maintenance_training" value="Yes">
                <label class="form-check-label">Maintenance Training Given</label>
            </div>

            <!-- SAFETY -->
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="safety_guidelines" value="Yes">
                <label class="form-check-label">Safety Guidelines Explained</label>
            </div>

            <!-- MOBILE APP -->
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="mobile_app_training" value="Yes">
                <label class="form-check-label">Mobile App Training Given</label>
            </div>
        </div>

        <!-- HANDOVER STATUS -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Handover Status</label>
            <select name="handover_status" class="form-control">
                <option value="Completed">Completed</option>
                <option value="Pending">Pending</option>
            </select>
        </div>
        <!-- FINAL HANDOVER & SIGN-OFF -->

        <div class="mb-4">
            <label class="fw-bold mb-3 d-block">Final Handover & Sign-off</label>

            <!-- SIGNED BY -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Signed By</label>
                <input type="text"name="signed_by"class="form-control"placeholder="Enter customer name">
            </div>

            <!-- SIGNED DATE -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Signed Date</label>
                <input type="date" name="signed_date" class="form-control">
            </div>

            <!-- SIGNED DOCUMENT -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Signed Document</label>
                <input type="file" name="signed_document" class="form-control">
                <small class="text-muted">Upload signed handover document</small>
            </div>
        </div>

        <!-- REMARKS -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Remarks</label>
            <textarea name="remarks" rows="4" class="form-control" placeholder="Enter additional notes here..."></textarea>
        </div>

        <!-- SUBMIT BUTTON -->
        <button type="submit" class="btn btn-success"><i class="fa fa-save me-1"></i>Save Handover</button>
    </form>
</div>
@endsection