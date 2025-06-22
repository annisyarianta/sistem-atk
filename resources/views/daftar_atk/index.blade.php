@extends('layouts.app')

@section('title')
    Daftar ATK | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase fw-bold">Daftar Stok ATK</h3>
        <div>
            <button
                type="button"
                class="btn btn-sm btn-grd btn-grd-danger me-1"
                id="exportPdfBtn">
                Export PDF
            </button>
            <button
                type="button"
                class="btn btn-sm btn-grd btn-grd-success me-1"
                id="exportExcelBtn">
                Export Excel
            </button>
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
                            <th class="text-center align-middle" style="width: 70px">
                                Kode ATK
                            </th>
                            <th class="text-center align-middle" style="width: 320px">
                                Nama ATK
                            </th>
                            <th class="text-center align-middle" style="width: 150px">
                                Jenis ATK
                            </th>
                            <th class="text-center align-middle">
                                Jumlah ATK
                            </th>
                            <th class="text-center align-middle">
                                Satuan
                            </th>
                            <th class="text-center align-middle" style="width: 150px">
                                Gambar
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarAtk as $index => $atk)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $atk->kode_atk }}</td>
                                <td>{{ $atk->nama_atk }}</td>
                                <td class="text-center">
                                    @if ($atk->jenis_atk == 'habis_pakai')
                                        <span class="badge rounded-pill bg-grd-warning">Habis Pakai</span>
                                    @elseif($atk->jenis_atk == 'tidak_habis_pakai')
                                        <span class="badge rounded-pill bg-grd-info">Tidak Habis Pakai</span>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-grd-royal">{{ ucfirst(str_replace('_', ' ', $atk->jenis_atk)) }}</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $atk->stok_saat_ini }}</td>
                                <td class="text-center">{{ $atk->satuan }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-content-center p-1">
                                        <img src="{{ $atk->gambar_atk ? asset('storage/' . $atk->gambar_atk) : asset('images/logo-injourney-airport.png') }}"
                                            alt="Gambar ATK" style="max-width: 150px; max-height: 180px;">
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        @if (session('success'))
            round_success_noti("{{ session('success') }}");
        @endif

        @if (session('error'))
            round_error_noti("{{ session('error') }}");
        @endif
    </script>
@endsection
