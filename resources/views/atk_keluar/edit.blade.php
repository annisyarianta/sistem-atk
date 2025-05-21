@extends('layouts.app')

@section('title')
    Edit ATK Keluar | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase">Edit ATK Keluar</h3>
    </div>
    <hr />
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4 text-primary">Form Edit ATK Keluar</h5>
            <form action="{{ url('/atk-keluar/update/' . $atkKeluar->id_keluar) }}" method="POST"
                enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="row mb-3">
                    <label for="searchInput" class="col-sm-3 col-form-label">Nama ATK</label>
                    <div class="searchable-dropdown col-sm-9">
                        <input type="text" id="searchInput" placeholder="--- Pilih ATK ---" onkeyup="filterFunction()"
                            class="form-control @error('id_atk') is-invalid @enderror"
                            value="{{ old('nama_atk', $atkKeluar->masterAtk->nama_atk ?? '') }}" required
                            autocomplete="off">
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                        <div id="dropdownList" class="dropdown-content">
                            @foreach ($masterAtk as $atk)
                                <a href="#"
                                    onclick="selectOption('{{ $atk->id_atk }}', '{{ $atk->nama_atk }}')">{{ $atk->nama_atk }}</a>
                            @endforeach
                        </div>
                        <div class="invalid-feedback">
                            @error('id_atk')
                                {{ $message }}
                            @else
                                Please choose one.
                            @enderror
                        </div>
                        <input type="hidden" name="id_atk" id="id_atk"
                            value="{{ old('id_atk', $atkKeluar->id_atk ?? '') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal_keluar" class="col-sm-3 col-form-label">Tanggal ATK Keluar</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar"
                            value="{{ old('tanggal_keluar', $atkKeluar->tanggal_keluar) }}" required>
                        <div class="invalid-feedback">
                            Please select date.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jumlah_keluar" class="col-sm-3 col-form-label">Jumlah ATK Keluar</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="jumlah_keluar" name="jumlah_keluar"
                            placeholder="Masukkan jumlah ATK" value="{{ old('jumlah_keluar', $atkKeluar->jumlah_keluar) }}"
                            required>
                        <div class="invalid-feedback">
                            Please enter a valid number.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="id_unit" class="col-sm-3 col-form-label">Unit</label>
                    <div class="col-sm-9">
                        <select name="id_unit" id="id_unit" class="form-select @error('id_unit') is-invalid @enderror"
                            required>
                            <option disabled {{ old('id_unit', $atkKeluar->id_unit ?? '') == '' ? 'selected' : '' }}
                                value="">
                                --- Pilih Unit ---
                            </option>
                            @foreach ($masterUnit as $unit)
                                <option value="{{ $unit->id_unit }}"
                                    {{ old('id_unit', $atkKeluar->id_unit ?? '') == $unit->id_unit ? 'selected' : '' }}>
                                    {{ $unit->nama_unit }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please enter a valid number.
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-md-flex d-grid align-items-center justify-content-lg-end gap-3">
                            <a href="{{ url('/atk-keluar') }}" class="btn btn-secondary raised px-4">
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

    <script>
        // Filter function untuk pencarian dropdown
        function filterFunction() {
            var input, filter, div, a, i;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            div = document.getElementById("dropdownList");
            a = div.getElementsByTagName("a");

            // Menyaring daftar berdasarkan input
            for (i = 0; i < a.length; i++) {
                if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }

        // Fungsi untuk memilih item dan mengisi input tersembunyi
        function selectOption(id, name) {
            document.getElementById("searchInput").value = name;
            document.getElementById("id_atk").value = id;
            document.getElementById("dropdownList").style.display =
                "none"; // Menyembunyikan dropdown setelah pilihan dipilih
        }

        // Menyembunyikan dropdown ketika klik di luar input atau dropdown
        window.onclick = function(event) {
            if (!event.target.matches('#searchInput') && !event.target.matches('.dropdown-content a')) {
                document.getElementById("dropdownList").style.display = "none";
            }
        }

        // Menampilkan dropdown saat input aktif
        document.getElementById("searchInput").onclick = function() {
            document.getElementById("dropdownList").style.display = "block";
        }
    </script>
@endsection
