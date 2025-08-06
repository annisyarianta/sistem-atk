@extends('layouts.app')

@section('title')
    ATK Masuk | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase fw-bold">ATK Masuk</h3>
        <div>
            <button type="button" class="btn btn-sm btn-grd btn-grd-danger me-1" id="exportPdfBtn">
                Export PDF
            </button>
            <button type="button" class="btn btn-sm btn-grd btn-grd-success me-1" id="exportExcelBtn">
                Export Excel
            </button>
            <button type="button" class="btn btn-sm btn-grd btn-grd-info" data-bs-toggle="modal"
                data-bs-target="#ScrollableModal">
                Tambah Data
            </button>
            <!-- Modal -->
            <div class="modal fade" id="ScrollableModal" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0 bg-grd-deep-blue py-2">
                            <h5 class="modal-title text-light">
                                Tambah Data ATK Masuk
                            </h5>
                            <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                <i class="material-icons-outlined text-light">close</i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="form-body">
                                <form action="{{ route('atk-masuk.store') }}" method="POST" enctype="multipart/form-data"
                                    class="row g-3">
                                    @csrf
                                    <div class="col-md-12">
                                        <label for="searchInput" class="form-label">Nama ATK</label>
                                        <div class="searchable-dropdown">
                                            <input type="text" id="searchInput" placeholder="--- Pilih ATK ---"
                                                onkeyup="filterFunction()"
                                                class="form-control @error('id_atk') is-invalid @enderror"
                                                value="{{ old('nama_atk') }}" autocomplete="off">
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
                                                @enderror
                                            </div>
                                            <input type="hidden" name="id_atk" id="id_atk" value="{{ old('id_atk') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="tanggal_masuk" class="form-label">Tanggal ATK Masuk</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                            id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}">
                                        <div class="invalid-feedback">
                                            @error('tanggal_masuk')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jumlah_masuk" class="form-label">Jumlah ATK Masuk</label>
                                        <input type="number"
                                            class="form-control @error('jumlah_masuk') is-invalid @enderror"
                                            id="jumlah_masuk" name="jumlah_masuk" placeholder="Masukkan jumlah ATK"
                                            value="{{ old('jumlah_masuk') }}">
                                        <div class="invalid-feedback">
                                            @error('jumlah_masuk')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                        <input type="number" class="form-control @error('harga_satuan') is-invalid @enderror" id="harga_satuan" name="harga_satuan"
                                            placeholder="Masukkan harga" value="{{ old('harga_satuan') }}">
                                        <div class="invalid-feedback">
                                            @error('harga_satuan')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top-0 pb-0">
                                        <button type="button" class="btn btn-secondary raised" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary raised">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var myModal = new bootstrap.Modal(document.getElementById('ScrollableModal'));
                        myModal.show();
                    });
                </script>
            @endif

        </div>
    </div>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-bordered table-striped table-hover" style="width: 100%">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center align-middle" style="width: 30px">
                                No.
                            </th>
                            <th class="text-center align-middle" style="width: 68px">
                                Kode ATK
                            </th>
                            <th class="text-center align-middle" style="width: 320px">
                                Nama ATK
                            </th>
                            <th class="text-center align-middle">
                                Tanggal ATK Masuk
                            </th>
                            <th class="text-center align-middle">
                                Jumlah ATK Masuk
                            </th>
                            <th class="text-center align-middle">
                                Harga Satuan
                            </th>
                            <th class="text-center align-middle">
                                Harga Total
                            </th>
                            <th class="text-center align-middle" style="width: 80px">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataMasuk as $index => $atk)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $atk->masterAtk->kode_atk ?? '-' }}</td>
                                <td>{{ $atk->masterAtk->nama_atk ?? '-' }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($atk->tanggal_masuk)->format('d/m/Y') }}
                                </td>
                                <td class="text-center">{{ $atk->jumlah_masuk }}</td>
                                <td class="text-center">{{ number_format($atk->harga_satuan, 0, ',', '.') }}</td>
                                <td class="text-center">{{ number_format($atk->harga_total, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('atk-masuk.edit', $atk->id_masuk) }}"
                                            class="btn btn-warning raised p-1" title="Edit"
                                            style="
                                            width: 30px;
                                            height: 30px;
                                        ">
                                            <i class="material-icons-outlined" style="font-size: 16px">edit</i></a>
                                        <form action="{{ route('atk-masuk.destroy', $atk->id_masuk) }}" method="POST"
                                            class="delete-masuk" data-id="{{ $atk->id_masuk }}"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="btn delete btn-danger raised d-flex align-items-center justify-content-center p-1"
                                                style="width: 30px; height: 30px;">
                                                <i class="material-icons-outlined" style="font-size: 16px">delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-masuk').forEach(function(form) {
                form.querySelector('.delete').addEventListener('click', function(e) {
                    e.preventDefault();
                    const masukId = form.getAttribute('data-id');

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Gagal menghapus data.'
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection
