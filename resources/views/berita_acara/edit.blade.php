@extends('layouts.app')

@section('title')
    Edit Berita Acara | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase fw-bold">Edit Berita Acara</h3>
    </div>
    <hr />
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4 text-primary">Form Edit Berita Acara</h5>
            <form action="{{ route('berita-acara.update', $beritaAcara->id_ba) }}" method="POST" enctype="multipart/form-data"
                class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row mb-3">
                    <label for="tanggal_ba" class="col-sm-3 col-form-label">Tanggal Berita Acara</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_ba" name="tanggal_ba"
                            value="{{ old('tanggal_ba', $beritaAcara->tanggal_ba) }}" required>
                        <div class="invalid-feedback">
                            Please enter a valid date.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="referensi" class="col-sm-3 col-form-label">Referensi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('referensi') is-invalid @enderror" id="referensi" name="referensi"
                            placeholder="Masukkan no. nota dinas" value="{{ old('referensi', $beritaAcara->referensi) }}"
                            required>
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
                    <label for="diketahui" class="col-sm-3 col-form-label">Diketahui Oleh</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="diketahui" name="diketahui"
                            placeholder="Diketahui oleh..." value="{{ old('diketahui', $beritaAcara->diketahui) }}"
                            required />
                        <div class="invalid-feedback">
                            Please enter a valid input.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerima" class="col-sm-3 col-form-label">Penerima</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="penerima" name="penerima"
                            placeholder="Masukkan penerima" value="{{ old('penerima', $beritaAcara->penerima) }}"
                            required />
                        <div class="invalid-feedback">
                            Please enter a valid input.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jabatan_penerima" class="col-sm-3 col-form-label">Jabatan Penerima</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jabatan_penerima" name="jabatan_penerima"
                            placeholder="Masukkan jabatan penerima"
                            value="{{ old('jabatan_penerima', $beritaAcara->jabatan_penerima) }}" required />
                        <div class="invalid-feedback">
                            Please enter a valid input.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kode_barcode" class="col-sm-3 col-form-label">Kode Barcode</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_barcode" name="kode_barcode"
                            placeholder="Masukkan kode barcode"
                            value="{{ old('kode_barcode', $beritaAcara->kode_barcode) }}" />
                        <div class="invalid-feedback">
                            Please enter a valid input.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="lampiran" class="col-sm-3 col-form-label">Lampiran BA</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="lampiran" name="lampiran[]"
                            accept="image/jpeg,image/jpg,image/png" multiple onchange="previewLampiran(this)">
                        <div class="form-text">Upload ulang jika ingin mengganti lampiran. Gambar lama akan terhapus.</div>

                        {{-- Preview gambar baru --}}
                        <div id="preview-container" class="mt-3 d-flex flex-wrap gap-2"></div>

                        {{-- (Opsional) Preview gambar lama --}}
                        @if ($beritaAcara->lampiran && is_array($beritaAcara->lampiran))
                            <div class="mt-3">
                                <p>Lampiran Saat Ini:</p>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($beritaAcara->lampiran as $file)
                                        <img src="{{ asset('uploads/lampiran/' . $file) }}" width="100px"
                                            class="img-thumbnail">
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row pt-3">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-md-flex d-grid align-items-center justify-content-lg-end gap-3">
                            <a href="{{ route('berita-acara.index') }}" class="btn btn-secondary raised px-4">
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
