@extends('layouts.app')

@section('content')

<div class="container">

    <h3>Installation Details</h3>

    <!-- BASIC INFO -->
    <div class="card p-3 mb-3">
        <p><b>Customer:</b> {{ $installation->customer_id }}</p>
        <p><b>Status:</b> {{ $installation->status }}</p>
        <p><b>Progress:</b> {{ $installation->progress }}%</p>
    </div>

    <!-- UPLOAD FORM -->
    @include('installations.upload_form')

    <!-- 📸 YOUR GALLERY CODE GOES HERE -->
    @php
    $uploads = DB::table('installation_uploads')
        ->where('installation_id', $installation->id)
        ->get();
    @endphp

    <div class="row g-2">

    @foreach($uploads as $u)
        <div class="col-md-3">

            <div class="card shadow-sm">

                @if(in_array($u->file_type, ['jpg','jpeg','png']))
                    <img src="{{ asset('storage/'.$u->file_path) }}"
                         class="img-fluid rounded">
                @else
                    <div class="p-3 text-center">
                        📄 Document
                    </div>
                @endif

                <div class="p-2 text-center">
                    <span class="badge bg-secondary">
                        {{ ucfirst($u->stage) }}
                    </span>
                </div>

            </div>

        </div>
    @endforeach

    </div>

</div>

@endsection