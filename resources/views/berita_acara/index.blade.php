@extends('layouts.app')

@section('title')
    Berita Acara | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase">Berita Acara</h3>
        <div>
            <a href="{{ route('berita-acara.create') }}" class="btn btn-sm btn-grd btn-grd-primary">
                Cetak Berita Acara
            </a>
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
                            <th class="text-center align-middle" style="width: 180px">
                                No. Nota Dinas
                            </th>
                            <th class="text-center align-middle" style="width: 150px">
                                Tanggal BA
                            </th>
                            <th class="text-center align-middle" style="width: 180px">
                                Unit
                            </th>
                            <th class="text-center align-middle" style="width: 150px">
                                Tanggal ATK Keluar
                            </th>
                            <th class="text-center align-middle" style="width: 110px">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataBA as $index => $ba)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $ba->referensi ?? '-' }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($ba->tanggal_ba)->format('d/m/Y') }}
                                </td>
                                <td class="text-center">{{ $ba->unit->nama_unit ?? '-' }}</td>
                                <td class="text-center">
                                    {{ optional($ba->atkKeluar->first())->tanggal_keluar ?? '-' }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('berita-acara.download', $ba->id_ba) }}"
                                            class="btn btn-primary raised p-1" title="Download"
                                            style="width: 30px; height: 30px;">
                                            <i class="material-icons-outlined" style="font-size: 16px">download</i></a>
                                        <a href="{{ route('berita-acara.edit', $ba->id_ba) }}"
                                            class="btn btn-warning raised p-1" title="Edit"
                                            style="
                                                width: 30px;
                                                height: 30px;
                                            ">
                                            <i class="material-icons-outlined" style="font-size: 16px">edit</i></a>
                                        <a href="#" class="btn btn-secondary raised p-1" data-bs-toggle="modal"
                                            data-bs-target="#modalDetail{{ $ba->id_ba }}" title="Detail"
                                            style="
                                                width: 30px;
                                                height: 30px;
                                            ">
                                            <i class="material-icons-outlined" style="font-size: 16px">visibility</i>
                                        </a>
                                    </div>
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

    <!-- Modal Detail -->
    {{-- <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 bg-grd-royal py-2">
                    <h4 class="modal-title text-light" id="exampleModalScrollableTitle">Detail Berita Acara</h4>
                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                        <i class="material-icons-outlined text-light">close</i>
                    </a>
                </div>
                <div class="modal-body card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <!-- <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                    </tr>
                                </thead> -->
                            <tbody>
                                <tr>
                                    <th scope="row">Tanggal Berita Acara</th>
                                    <td>5/5/2025</td>
                                </tr>
                                <tr>
                                    <th scope="row">No. Nota Dinas</th>
                                    <td>xx/123/API/2025</td>
                                </tr>
                                <tr>
                                    <th scope="row">Unit</th>
                                    <td>SAFETY RISK & QUALITY CONTROL</td>
                                </tr>
                                <tr>
                                    <th scope="row">Periode ATK Keluar</th>
                                    <td>2008/11/28</td>
                                </tr>
                                <tr>
                                    <th scope="row">Diketahui oleh</th>
                                    <td>Rahaditya</td>
                                </tr>
                                <tr>
                                    <th scope="row">Penerima</th>
                                    <td>Rianta</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jabatan penerima</th>
                                    <td>Assistant Manager of SRQC</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kode Barcode</th>
                                    <td>ABCDEFG123</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama Barang/Jumlah</th>
                                    <td>
                                        <ul class="mb-0">
                                            <li>Tinta Epson / 2 PCS</li>
                                            <li>Kertas A4 / 1 RIM</li>
                                            <li>Tempat Brosur Akrilik A5 Vertikal / 1 PCS</li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Modal Detail -->
    <div class="modal fade" id="modalDetail{{ $ba->id_ba }}" tabindex="-1" role="dialog"
        aria-labelledby="modalDetailLabel{{ $ba->id_ba }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 bg-grd-royal py-2">
                    <h4 class="modal-title text-light" id="modalDetailLabel{{ $ba->id_ba }}">Detail Berita Acara
                    </h4>
                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                        <i class="material-icons-outlined text-light">close</i>
                    </a>
                </div>
                <div class="modal-body card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row">Tanggal Berita Acara</th>
                                    <td>{{ \Carbon\Carbon::parse($ba->tanggal_ba)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">No. Nota Dinas</th>
                                    <td>{{ $ba->referensi }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Unit</th>
                                    <td>{{ $ba->unit->nama_unit ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Periode ATK Keluar</th>
                                    <td>
                                        {{ optional($ba->atkKeluar->first())->tanggal_keluar
                                            ? \Carbon\Carbon::parse($ba->atkKeluar->sortBy('tanggal_keluar')->first()->tanggal_keluar)->format('d/m/Y')
                                            : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Diketahui oleh</th>
                                    <td>{{ $ba->diketahui }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Penerima</th>
                                    <td>{{ $ba->penerima }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jabatan penerima</th>
                                    <td>{{ $ba->jabatan_penerima }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kode Barcode</th>
                                    <td>{{ $ba->kode_barcode }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama Barang/Jumlah</th>
                                    <td>
                                        <ul class="mb-0">
                                            @foreach ($ba->atkKeluar as $item)
                                                <li>
                                                    {{ $item->masterAtk->nama_atk ?? '-' }} /
                                                    {{ $item->jumlah_keluar }} {{ $item->masterAtk->satuan ?? '' }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $("#example").DataTable({
                dom: "lfrtip",
                buttons: [{
                        extend: "excel",
                        className: "btn-excel"
                    },
                    {
                        extend: "pdf",
                        className: "btn-pdf"
                    },
                ],
            });

            $("#exportExcelBtn").on("click", function() {
                table.button(".btn-excel").trigger();
            });

            $("#exportPdfBtn").on("click", function() {
                table.button(".btn-pdf").trigger();
            });

            table
                .buttons()
                .container()
                .appendTo("#example_wrapper .col-md-6:eq(0)");
        });
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            "use strict";

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll(".needs-validation");

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener(
                    "submit",
                    function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add("was-validated");
                    },
                    false,
                );
            });
        })();
    </script>
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
            document.getElementById("atk_id").value = id;
            document.getElementById("dropdownList").style.display =
                "none"; // Menyembunyikan dropdown setelah pilihan dipilih
        }

        // Menyembunyikan dropdown ketika klik di luar input atau dropdown
        window.onclick = function(event) {
            if (
                !event.target.matches("#searchInput") &&
                !event.target.matches(".dropdown-content a")
            ) {
                document.getElementById("dropdownList").style.display =
                    "none";
            }
        };

        // Menampilkan dropdown saat input aktif
        document.getElementById("searchInput").onclick = function() {
            document.getElementById("dropdownList").style.display = "block";
        };
    </script>
@endsection
