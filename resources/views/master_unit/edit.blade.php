@extends('layouts.app')

@section('title')
    Edit Master Unit | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase">Edit Data Unit</h3>
    </div>
    <hr />
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4 text-primary">Form Edit Master Unit</h5>
            <form action="{{ route('master-unit.update', $unit->id_unit) }}" method="POST" enctype="multipart/form-data"
                class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="nama_unit" class="col-sm-3 col-form-label">Nama Unit</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nama_unit') is-invalid @enderror"" id="nama_unit" name="nama_unit"
                            value="{{ old('nama_unit', $unit->nama_unit) }}" required>
                        <div class="invalid-feedback">
                            @error('nama_unit')
                                {{ $message }}
                            @else
                                Please enter a valid input.
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-md-flex d-grid align-items-center justify-content-lg-end gap-3">
                            <a href="{{ url('/master-unit') }}" class="btn btn-secondary raised px-4">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-warning raised px-4 text-light">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
