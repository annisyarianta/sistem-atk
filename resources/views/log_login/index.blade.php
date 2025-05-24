@extends('layouts.app')

@section('title')
    Log Login | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase">Log Login</h3>
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
                            <th class="text-center align-middle" style="width: 320px">
                                Nama Pengguna
                            </th>
                            <th class="text-center align-middle" style="width: 150px">
                                Waktu Login
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $index => $log)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $log->user->nama ?? '-' }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($log->waktu_login)->format('d-m-Y H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum ada data.</td>
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