@extends('layouts.app')

@section('title')
    Cetak Berita Acara | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase fw-bold">Tambah Berita Acara</h3>
    </div>
    <hr />
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4 text-primary">Form Tambah BA</h5>
            <form action="{{ route('berita-acara.store') }}" method="POST" enctype="multipart/form-data"
                class="needs-validation" novalidate>
                @csrf
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row mb-3">
                    <label for="tanggal_ba" class="col-sm-3 col-form-label">Tanggal Berita Acara</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_ba" name="tanggal_ba"
                            value="{{ old('tanggal_ba') }}" required>
                        <div class="invalid-feedback">
                            Please enter a valid date.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="referensi" class="col-sm-3 col-form-label">Referensi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="referensi" name="referensi"
                            placeholder="Masukkan no. nota dinas" value="{{ old('referensi') }}" required>
                            <div class="invalid-feedback">
                                @error('referensi')
                                    {{ $message }}
                                @else
                                    Please enter a valid input.
                                @enderror
                            </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="id_unit" class="col-sm-3 col-form-label">Unit</label>
                    <div class="col-sm-9">
                        <select name="id_unit" id="id_unit"
                            class="form-select form-control @error('id_unit') is-invalid @enderror" required>
                            <option disabled {{ old('id_unit') ? '' : 'selected' }} value="">
                                --- Pilih Unit ---
                            </option>
                            @foreach ($masterUnit as $unit)
                                <option value="{{ $unit->id_unit }}"
                                    {{ old('id_unit') == $unit->id_unit ? 'selected' : '' }}>
                                    {{ $unit->nama_unit }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please choose one.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_keluar" class="col-sm-3 col-form-label">Periode ATK Keluar</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar"
                            value="{{ old('tanggal_keluar') }}" required>
                        <div class="invalid-feedback">
                            Please enter a valid date.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="diketahui" class="col-sm-3 col-form-label">Diketahui Oleh</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="diketahui" name="diketahui"
                            placeholder="Diketahui oleh..." value="{{ old('diketahui') }}" required />
                        <div class="invalid-feedback">
                            Please enter a valid input.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="menyetujui" class="col-sm-3 col-form-label">Disetujui Oleh</label>
                    <div class="col-sm-9">
                        <select name="menyetujui" id="menyetujui" class="form-select form-control" required>
                            <option value="" disabled selected>-- Pilih salah satu --</option>
                            <option value="Rahaditya Saputra">Rahaditya Saputra</option>
                            <option value="Dian Hardiansah">Dian Hardiansah</option>
                        </select>
                        <div class="invalid-feedback">
                            Please enter a valid input.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerima" class="col-sm-3 col-form-label">Penerima</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="penerima" name="penerima"
                            placeholder="Masukkan penerima" value="{{ old('penerima') }}" required />
                        <div class="invalid-feedback">
                            Please enter a valid input.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jabatan_penerima" class="col-sm-3 col-form-label">Jabatan Penerima</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jabatan_penerima" name="jabatan_penerima"
                            placeholder="Masukkan jabatan penerima" value="{{ old('jabatan_penerima') }}" required />
                        <div class="invalid-feedback">
                            Please enter a valid input.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kode_barcode" class="col-sm-3 col-form-label">Kode Barcode</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_barcode" name="kode_barcode"
                            placeholder="Masukkan kode barcode" value="{{ old('kode_barcode') }}" />
                        <div class="invalid-feedback">
                            Please enter a valid input.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="lampiran" class="col-sm-3 col-form-label">Upload Lampiran BA</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="lampiran" name="lampiran[]"
                            accept="image/jpeg,image/jpg,image/png" multiple onchange="previewLampiran(this)">
                            <small>Upload gambar jika ada (.jpg, *.jpeg, *.png), maks. 5 MB</small>

                        {{-- Preview gambar --}}
                        <div id="preview-container" class="mt-3 d-flex flex-wrap gap-2"></div>
                    </div>
                </div>
                <div class="row pt-3">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-md-flex d-grid align-items-center justify-content-lg-end gap-3">
                            <a class="btn btn-secondary raised px-4" href="{{ route('berita-acara.index') }}">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary raised px-4 text-light">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewLampiran(input) {
                const container = document.getElementById('preview-container');
                container.innerHTML = '';

                if (input.files) {
                    Array.from(input.files).forEach(file => {
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.width = '100px';
                                img.style.height = 'auto';
                                img.style.objectFit = 'cover';
                                img.classList.add('border', 'rounded');
                                container.appendChild(img);
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }
            }
        </script>
    @endpush
@endsection
