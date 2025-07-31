@extends('layouts.app')

@section('title')
    Edit User | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase fw-bold">Edit Data User</h3>
    </div>
    <hr />
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4 text-primary">Form Edit Data User</h5>
            <form action="{{ route('kelola-user.update', $user->id_user) }}" method="POST" enctype="multipart/form-data"
                class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="role" class="col-sm-3 col-form-label">Role</label>
                    <div class="col-sm-9">
                        <select name="role" id="role"
                            class="form-select form-control @error('role') is-invalid @enderror" required>
                            <option disabled {{ old('role', $user->role) ? '' : 'selected' }} value="">--- Pilih Role ---
                            </option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin
                            </option>
                            <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>Staff
                            </option>
                        </select>
                        <div class="invalid-feedback">
                            Please choose one.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="id_unit" class="col-sm-3 col-form-label">Unit</label>
                    <div class="col-sm-9">
                        <select name="id_unit" id="id_unit" class="form-select @error('id_unit') is-invalid @enderror"
                            required>
                            <option disabled {{ old('id_unit', $user->id_unit ?? '') == '' ? 'selected' : '' }}
                                value="">
                                --- Pilih Unit ---
                            </option>
                            @foreach ($masterUnit as $unit)
                                <option value="{{ $unit->id_unit }}"
                                    {{ old('id_unit', $user->id_unit ?? '') == $unit->id_unit ? 'selected' : '' }}>
                                    {{ $unit->nama_unit }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please enter a valid number.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama"
                        placeholder="Masukkan nama pengguna" value="{{ old('nama', $user->nama) }}" required />
                        <div class="invalid-feedback">
                            Please enter a valid name.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email pengguna"
                            name="email" value="{{ old('email', $user->email) }}" required />
                        <div class="invalid-feedback">
                            @error('email')
                                {{ $message }}
                            @else
                                Please enter a valid email.
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-md-flex d-grid align-items-center justify-content-lg-end gap-3">
                            <a href="{{ route('kelola-user.index') }}" class="btn btn-secondary raised px-4">
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
