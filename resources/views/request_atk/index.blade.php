@extends('layouts.app')

@section('title')
    Permohonan ATK | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase fw-bold">Permohonan ATK</h3>
        <div>
            {{-- <button type="button" class="btn btn-sm btn-grd btn-grd-primary me-1 px-3"
                onclick="window.location.href='cetak-ba.html'">
                Cetak BA
            </button> --}}
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
                                Tambah Permohonan ATK
                            </h5>
                            <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                <i class="material-icons-outlined text-light">close</i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="form-body">
                                <form action="{{ route('request-atk.store') }}" method="POST" enctype="multipart/form-data"
                                    class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div class="col-md-12">
                                        <label for="searchInput" class="form-label">Nama ATK</label>
                                        <div class="searchable-dropdown">
                                            <input type="text" id="searchInput" placeholder="--- Pilih ATK ---"
                                                onkeyup="filterFunction()"
                                                class="form-control @error('id_atk') is-invalid @enderror"
                                                value="{{ old('nama_atk') }}" required autocomplete="off">
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
                                            <input type="hidden" name="id_atk" id="id_atk" value="{{ old('id_atk') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="tanggal_request" class="form-label">Tanggal Request</label>
                                        <input type="date" class="form-control" id="tanggal_request"
                                            name="tanggal_request" value="{{ old('tanggal_request') }}" required>
                                        <div class="invalid-feedback">
                                            Please select date.
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="jumlah_request" class="form-label">Jumlah Request</label>
                                        <input type="number" class="form-control" id="jumlah_request" name="jumlah_request"
                                            placeholder="Masukkan jumlah ATK" value="{{ old('jumlah_request') }}" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid number.
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
                            <th class="text-center align-middle" style="width: 80px">
                                Kode ATK
                            </th>
                            <th class="text-center align-middle" style="width: 200px">
                                Nama ATK
                            </th>
                            <th class="text-center align-middle" style="width: 120px">
                                Tanggal Request
                            </th>
                            <th class="text-center align-middle" style="width: 80px">
                                Jumlah Request
                            </th>
                            <th class="text-center align-middle" style="width: 90px">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataRequest as $index => $req)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $req->masterAtk->kode_atk ?? '-' }}</td>
                                <td>{{ $req->masterAtk->nama_atk ?? '-' }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($req->tanggal_request)->format('d/m/Y') }}
                                </td>
                                <td class="text-center">{{ $req->jumlah_request }}</td>
                                <td class="text-center">
                                    @if ($req->status == 'pending')
                                        <span class="badge rounded-pill bg-grd-royal">Pending</span>
                                    @elseif($req->status == 'approved')
                                        <span class="badge rounded-pill bg-grd-success">Approved</span>
                                    @elseif($req->status == 'rejected')
                                        <span class="badge rounded-pill bg-grd-danger">Rejected</span>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-grd-warning">{{ ucfirst(str_replace('_', ' ', $req->status)) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data</td>
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
@endsection
