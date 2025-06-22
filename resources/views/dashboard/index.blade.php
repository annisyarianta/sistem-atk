@extends('layouts.app')

@section('title')
    Dashboard | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase fw-bold">Dashboard</h3>
    </div>
    <hr />
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
        <div class="col">
            <div class="card rounded-4 bg-grd-deep-blue">
                <div class="card-body" style="position: relative">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="wh-48 d-flex align-items-center justify-content-center"></div>
                        <img src="{{ asset('images/inventory.png') }}" height="112" class="position-absolute top-0 pt-2" />
                        <div class="text-end text-uppercase text-light">
                            <p class="mb-0">Total ATK</p>
                            <h3 class="mb-0 text-light">{{ $jumlah_atk_keseluruhan }}</h3>
                            <p class="mb-0">Keseluruhan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 bg-grd-branding">
                <div class="card-body" style="position: relative">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="wh-48 d-flex align-items-center justify-content-center"></div>
                        <img src="{{ asset('images/courier.png') }}" height="113"
                            class="position-absolute bottom-0 start-0 ps-2" />
                        <div class="text-end text-uppercase text-light">
                            <p class="mb-0">ATK Masuk Bulan Ini</p>
                            <h3 class="mb-0 text-light">{{ $jumlah_atk_masuk_perbulan }}</h3>
                            <p class="mb-0">{{ \Carbon\Carbon::create()->month($selectedMonth)->locale('id')->translatedFormat('F') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 bg-grd-primary">
                <div class="card-body" style="position: relative">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="wh-48 d-flex align-items-center justify-content-center"></div>
                        <img src="{{ asset('images/distribution.png') }}" height="112" class="position-absolute top-0 start-0" />
                        <div class="text-end text-uppercase text-light">
                            <p class="mb-0">ATK Keluar Bulan Ini</p>
                            <h3 class="mb-0 text-light">{{ $jumlah_atk_keluar_perbulan }}</h3>
                            <p class="mb-0">{{ \Carbon\Carbon::create()->month($selectedMonth)->locale('id')->translatedFormat('F') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-4 bg-grd-danger">
                <div class="card-body" style="position: relative">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="wh-48 d-flex align-items-center justify-content-center"></div>
                        <img src="{{ asset('images/pending.png') }}" height="97" class="position-absolute"
                            style="left: -8px; top: 19px" />
                        <div class="text-end text-uppercase text-light">
                            <p class="mb-0">Total Permohonan ATK</p>
                            <h3 class="mb-0 text-light">{{ $pendingRequestCount }}</h3>
                            <p class="mb-0">Pending</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
        <div class="col">
            <div class="card rounded-4">
                <div class="card-header py-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <h5 class="mb-0">Pemasukan - Pengeluaran ATK Bulanan</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart1"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-4">
                <div class="card-header py-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <h5 class="mb-0">ATK Keluar Terbanyak : Bulan Ini</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart3"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xxl-12 d-flex">
            <div class="card rounded-4 w-100">
                <div class="card-header py-3">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="">
                            <h4 class="mb-0 text-uppercase fw-bold">
                                ATK Akan Habis
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th class="text-uppercase">
                                        Kode ATK
                                    </th>
                                    <th class="text-uppercase">
                                        Nama ATK
                                    </th>
                                    <th class="text-uppercase">
                                        Status
                                    </th>
                                    <th class="text-uppercase">
                                        Jumlah Stok
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ATK-001</td>
                                    <td>TINTA EPSON BLACK 001</td>
                                    <td>
                                        <span class="badge rounded-pill bg-grd-warning">Akan Habis</span>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">10</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ATK-001</td>
                                    <td>TINTA EPSON BLACK 001</td>
                                    <td>
                                        <span class="badge rounded-pill bg-grd-warning">Akan Habis</span>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">12</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ATK-001</td>
                                    <td>TINTA EPSON BLACK 001</td>
                                    <td>
                                        <span class="badge rounded-pill bg-grd-warning">Akan Habis</span>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">8</h6>
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
        @if (session('success'))
            round_success_noti("{{ session('success') }}");
        @endif

        @if (session('error'))
            round_error_noti("{{ session('error') }}");
        @endif
    </script>
@endsection
