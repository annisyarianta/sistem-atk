@extends('layouts.app')

@section('title')
    Edit Master ATK | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase fw-bold">Edit Data ATK</h3>
    </div>
    <hr />
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4 text-primary">Form Edit Master ATK</h5>
            <form action="{{ route('master-atk.update', $atk) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="nama_atk" class="col-sm-3 col-form-label">Nama ATK</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nama_atk') is-invalid @enderror" id="nama_atk"
                            name="nama_atk" placeholder="Masukkan nama ATK" value="{{ old('nama_atk', $atk->nama_atk) }}">
                        <div class="invalid-feedback">
                            @error('nama_atk')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kode_atk" class="col-sm-3 col-form-label">Kode ATK</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('kode_atk') is-invalid @enderror" id="kode_atk"
                            name="kode_atk" placeholder="Masukkan kode ATK" value="{{ old('kode_atk', $atk->kode_atk) }}">
                        <div class="invalid-feedback">
                            @error('kode_atk')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jenis_atk" class="col-sm-3 col-form-label">Jenis ATK</label>
                    <div class="col-sm-9">
                        <select id="jenis_atk" name="jenis_atk"
                            class="form-select form-control @error('jenis_atk') is-invalid @enderror">
                            <option value="habis_pakai" {{ $atk->jenis_atk == 'habis_pakai' ? 'selected' : '' }}>Habis Pakai
                            </option>
                            <option value="tidak_habis_pakai"
                                {{ $atk->jenis_atk == 'tidak_habis_pakai' ? 'selected' : '' }}>Tidak Habis Pakai</option>
                        </select>
                        <div class="invalid-feedback">
                            @error('jenis_atk')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="satuan" class="col-sm-3 col-form-label">Satuan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan"
                            name="satuan" placeholder="Masukkan satuan" value="{{ old('satuan', $atk->satuan) }}" />
                        <div class="invalid-feedback">
                            @error('satuan')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jumlah_minimum" class="col-sm-3 col-form-label">Jumlah Minimum</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control @error('jumlah_minimum') is-invalid @enderror"
                            id="jumlah_minimum" name="jumlah_minimum" placeholder="Masukkan jumlah minimum ATK"
                            value="{{ old('jumlah_minimum', $atk->jumlah_minimum) }}" />
                        <div class="invalid-feedback">
                            @error('jumlah_minimum')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Gambar Saat Ini</label>
                    <div class="col-sm-9">
                        <img src="{{ $atk->gambar_atk ? asset('storage/' . $atk->gambar_atk) : asset('images/logo-injourney-airport.png') }}"
                            alt="gambar_atk" width="80">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar_atk" class="col-sm-3 col-form-label">Ganti Gambar (opsional)</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="gambar_atk" name="gambar_atk" />
                        <small>Upload gambar jika ada (.jpg, *.jpeg, *.png), maks. 5 MB</small>
                        <div class="invalid-feedback">
                            Please enter a valid file.
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-md-flex d-grid align-items-center justify-content-lg-end gap-3">
                            <a href="{{ url('/master-atk') }}" class="btn btn-secondary raised px-4">
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
