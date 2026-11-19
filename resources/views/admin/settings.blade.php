@extends('layouts.app')

@section('content')

<div class="card-box">

    <div class="d-flex justify-content-between mb-3">
        <h5>System Settings</h5>
    </div>

    <!-- ✅ SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- ✅ FORM -->
    <form method="POST" action="/admin/settings/save">
        @csrf

        <div class="row g-2">

            <!-- 🔽 DROPDOWN -->
            <div class="col-md-5">
                <select name="key" class="form-control" required>
                    <option value="">-- Select Setting --</option>
                    <option value="tax_percent">Tax (%)</option>
                    <option value="tax_type">Tax Type</option>
                    <option value="subsidy_percent">Subsidy (%)</option>
                </select>
            </div>

            <!-- 🔢 VALUE INPUT -->
            <div class="col-md-5">
                <input type="text" name="value" class="form-control"
                       placeholder="Enter value (e.g. 18)" required>
            </div>

            <!-- 🔘 BUTTON -->
            <div class="col-md-2 text-end">
                <button class="btn btn-success btn-sm w-100">Save</button>
            </div>

        </div>
    </form>

    <hr class="my-4">

    <!-- ✅ SETTINGS TABLE -->
    <h6>Saved Settings</h6>

    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>Setting</th>
                <th>Value</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>

        <tbody>
        @forelse($settings as $setting)
            <tr>

                <!-- ✅ FIXED HERE -->
                <td>
                    @if($setting->name == 'tax_percent')
                        Tax (%)
                    @elseif($setting->name == 'tax_type')
                        Tax Type
                    @elseif($setting->name == 'subsidy_percent')
                        Subsidy (%)
                    @else
                        {{ $setting->name }}
                    @endif
                </td>

                <td>
                    @if($setting->name == 'tax_percent' || $setting->name == 'subsidy_percent')
                        {{ $setting->value }} %
                    @else
                        {{ $setting->value }}
                    @endif
                </td>

                <td class="text-end">

                    <!-- DELETE -->
                    <a href="/admin/settings/delete/{{ $setting->id }}"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this setting?')">
                       <i class="fa fa-trash"></i>
                    </a>

                </td>

            </tr>
        @empty
            <tr>
                <td colspan="3">No settings found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>

@endsection