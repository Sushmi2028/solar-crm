@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <!-- HEADER -->
    <div class="mb-4">
        <h2 class="fw-bold">⚡ Create Installation</h2>
        <p class="text-muted">Schedule a new solar installation and assign engineer</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- CARD -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Installation Details</h5>
                </div>

                <div class="card-body p-4">
                    <form method="POST"action="/installations/store"enctype="multipart/form-data">
                        @csrf
                        <!-- CUSTOMER -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Customer</label>
                            <select name="customer_id"class="form-select form-select-lg">
                                <option value="">Select Customer</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}">
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- QUOTATION -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Quotation</label>
                            <select name="quotation_id"class="form-select form-select-lg">
                                <option value="">Select Quotation</option>

                                @foreach($quotations as $q)
                                    <option value="{{ $q->id }}">
                                        Quote #{{ $q->id }} -
                                        ₹{{ $q->final_price ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ENGINEER -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Assign Engineer</label>
                            <select name="engineer_id"class="form-select form-select-lg">
                                <option value="">Select Engineer</option>

                                @foreach($engineers as $e)
                                    <option value="{{ $e->id }}">{{ $e->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- DATE -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Schedule Date</label>
                            <input type="date"name="schedule_date"class="form-control form-control-lg">
                        </div>

                        <!-- PROJECT PHOTO -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Project Photo</label>
                            <input type="file"name="project_photo"class="form-control form-control-lg"accept="image/*">
                            <small class="text-muted">Upload installation site photo(JPG, PNG, JPEG)</small>
                        </div>

                        <!-- INSTALLATION DOCUMENT -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Installation Document</label>
                            <input type="file"name="installation_document" class="form-control form-control-lg" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <small class="text-muted">Upload installation report or related document</small>
                        </div>

                        <!-- INFO BOX -->
                        <div class="alert alert-info border-0 rounded-3">
                            <i class="fa fa-info-circle me-2"></i>
                            Installation will be created with
                            <strong>Scheduled</strong> status,
                            <strong>0%</strong> progress.Uploaded photos and documents will be securely stored for future reference.
                        </div>

                        <!-- BUTTON -->
                        <button class="btn btn-primary btn-lg w-100 shadow-sm">
                            <i class="fa fa-save me-2"></i>Create Installation
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection