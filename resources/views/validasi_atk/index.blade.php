@extends('layouts.app')

@section('title')
    Validasi ATK | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase fw-bold">Validasi Permohonan ATK</h3>
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
                            <th class="text-center align-middle" style="width: 200px">
                                Nama ATK
                            </th>
                            <th class="text-center align-middle" style="width: 80px">
                                Jumlah Request
                            </th>
                            <th class="text-center align-middle" style="width: 150px">
                                Unit
                            </th>
                            <th class="text-center align-middle" style="width: 100px">
                                Tanggal Request
                            </th>
                            <th class="text-center align-middle" style="width: 100px">
                                Status
                            </th>
                            <th class="text-center align-middle" style="width: 110px">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $val)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $val->requestAtk->masterAtk->kode_atk ?? '-' }}</td>
                                <td>{{ $val->requestAtk->masterAtk->nama_atk ?? '-' }}</td>
                                <td class="text-center">{{ $val->requestAtk->jumlah_request }}</td>
                                <td class="text-center">{{ $val->requestAtk->user->unit->nama_unit ?? '-' }}</td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($val->requestAtk->tanggal_request)->format('d/m/Y') }}
                                </td>
                                <td class="text-center">
                                    @if ($val->requestAtk->status == 'pending')
                                        <span class="badge rounded-pill bg-grd-royal">Pending</span>
                                    @elseif($val->requestAtk->status == 'approved')
                                        <span class="badge rounded-pill bg-grd-success">Approved</span>
                                    @elseif($val->requestAtk->status == 'rejected')
                                        <span class="badge rounded-pill bg-grd-danger">Rejected</span>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-grd-warning">{{ ucfirst(str_replace('_', ' ', $val->requestAtk->status)) }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('validasi-atk.approve', $val->id_validasi) }}" method="POST"
                                            class="validasi-approve" data-id="{{ $val->id_validasi }}"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <button type="button"
                                                class="btn approve btn-success raised d-flex align-items-center justify-content-center p-1"
                                                id="approved" title="Setujui" style="width: 30px; height: 30px;">
                                                <i class="material-icons-outlined" style="font-size: 16px">check</i>
                                            </button>
                                        </form>
                                        <form action="{{ route('validasi-atk.reject', $val->id_validasi) }}" method="POST"
                                            class="validasi-reject" data-id="{{ $val->id_validasi }}"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <button type="button"
                                                class="btn reject btn-danger raised d-flex align-items-center justify-content-center p-1"
                                                id="rejected" title="Tolak" style="width: 30px; height: 30px;">
                                                <i class="material-icons-outlined" style="font-size: 16px">close</i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-warning raised p-1 edit-btn" title="Edit"
                                            data-id="{{ $val->id_validasi }}"
                                            data-jumlah="{{ $val->requestAtk->jumlah_request }}" data-bs-toggle="modal"
                                            data-bs-target="#editModal" style="width: 30px; height: 30px;">
                                            <i class="material-icons-outlined" style="font-size: 16px">edit</i>
                                        </button>
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 bg-grd-warning py-2">
                    <h5 class="modal-title text-light">
                        Edit Jumlah Permohonan ATK
                    </h5>
                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                        <i class="material-icons-outlined text-light">close</i>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <form id="editForm" method="POST" class="row g-3 needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <label for="jumlah_request" class="form-label">Jumlah yang
                                    disetujui</label>
                                <input type="number" class="form-control" id="edit_jumlah_request" name="jumlah_request"
                                    placeholder="Masukkan jumlah ATK" value="" required />
                                <div class="invalid-feedback">
                                    Jumlah ATK wajib diisi.
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 pb-0">
                                <button type="button" class="btn btn-secondary raised" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-warning raised text-light">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const jumlah = this.getAttribute('data-jumlah');

                    document.getElementById('edit_jumlah_request').value = jumlah;

                    const form = document.getElementById('editForm');
                    form.action = `/validasi-atk/${id}`;
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.validasi-approve').forEach(function(form) {
                form.querySelector('.approve').addEventListener('click', function(e) {
                    e.preventDefault();
                    const validasiId = form.getAttribute('data-id');

                    Swal.fire({
                        title: 'Validasi Permohonan ATK?',
                        text: 'Anda yakin akan menyetujui permohonan ATK ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, setujui',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Disetujui!',
                                text: 'Permohonan ATK tersebut telah disetujui.',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            }).then(() => {
                                form.submit();
                            });
                        }
                    });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.validasi-reject').forEach(function(form) {
                form.querySelector('.reject').addEventListener('click', function(e) {
                    e.preventDefault();
                    const validasiId = form.getAttribute('data-id');

                    Swal.fire({
                        title: 'Tolak Permohonan ATK?',
                        text: 'Anda yakin akan menolak permohonan ATK ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, tolak!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ditolak!',
                                text: 'Permohonan ATK tersebut telah ditolak.',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            }).then(() => {
                                form.submit();
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection
