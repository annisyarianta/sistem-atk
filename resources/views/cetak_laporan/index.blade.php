@extends('layouts.app')

@section('title')
    Cetak Laporan | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase fw-bold">Cetak Laporan</h3>
    </div>
    <hr />
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4 text-primary">Form Cetak Laporan</h5>
            <form action="{{ route('cetak-laporan.download') }}" method="POST" enctype="multipart/form-data"
                class="needs-validation" novalidate>
                @csrf
                <div class="row mb-3">
                    <label for="jenis_laporan" class="col-sm-3 col-form-label">Jenis Laporan</label>
                    <div class="col-sm-9">
                        <select id="jenis_laporan" name="jenis_laporan" class="form-select form-control" required>
                            <option disabled selected value="">--- Pilih jenis laporan ---</option>
                            <option value="atkmasuk">ATK Masuk</option>
                            <option value="atkkeluar">ATK Keluar</option>
                        </select>
                        <div class="invalid-feedback">
                            Please choose one.
                        </div>
                    </div>
                </div>
                <div class="row mb-3" id="unit-wrapper">
                    <label for="id_unit" class="col-sm-3 col-form-label">Unit</label>
                    <div class="col-sm-9">
                        <select id="id_unit" name="id_unit" class="form-select form-control">
                            <option value="">Semua Unit</option>
                            @foreach (\App\Models\MasterUnit::all() as $unit)
                                <option value="{{ $unit->id_unit }}">{{ $unit->nama_unit }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please choose one.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_awal" class="col-sm-3 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required>
                        <div class="invalid-feedback">
                            Please enter a valid date.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_akhir" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required />
                        <div class="invalid-feedback">
                            Please enter a valid email.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="format" class="col-sm-3 col-form-label">Format Dokumen</label>
                    <div class="col-sm-9">
                        <select id="format" name="format" class="form-select form-control" required>
                            <option disabled selected value="">--- Pilih format dokumen ---</option>
                            <option value="excel">Excel</option>
                            <option value="pdf">PDF</option>
                        </select>
                        <div class="invalid-feedback">
                            Please choose one.
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-md-flex d-grid align-items-center justify-content-lg-end gap-3">
                            <button type="submit"
                                class="btn btn-grd-deep-blue px-4 raised d-flex gap-2 justify-content-center text-light"><i
                                    class="material-icons-outlined">print</i>Cetak</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jenisLaporanSelect = document.getElementById('jenis_laporan');
            const unitWrapper = document.getElementById('unit-wrapper');
    
            function toggleUnit() {
                const selectedValue = jenisLaporanSelect.value;
                if (selectedValue === 'atkmasuk') {
                    unitWrapper.style.display = 'none';
                    // document.getElementById('id_unit').removeAttribute('required');
                } else if (selectedValue === 'atkkeluar') {
                    unitWrapper.style.display = 'flex';
                    // document.getElementById('id_unit').setAttribute('required', 'required');
                } else {
                    unitWrapper.style.display = 'none';
                }
            }
    
            toggleUnit();
    
            jenisLaporanSelect.addEventListener('change', toggleUnit);
        });
    </script>
@endsection
