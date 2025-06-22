@extends('layouts.app')

@section('title')
    Master Data Unit | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase fw-bold">Master Data Unit</h3>
        <div>
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
                                Tambah Data Unit
                            </h5>
                            <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                <i class="material-icons-outlined text-light">close</i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="form-body">
                                <form action="{{ route('master-unit.store') }}" method="POST" enctype="multipart/form-data"
                                    class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div class="col-md-12">
                                        <label for="nama_unit" class="form-label">Nama Unit</label>
                                        <input type="text" name="nama_unit"
                                            class="form-control @error('nama_unit') is-invalid @enderror" id="nama_unit"
                                            placeholder="Masukkan nama unit" value="{{ old('nama_unit') }}" required>
                                        <div class="invalid-feedback">
                                            @error('nama_unit')
                                                {{ $message }}
                                            @else
                                                Please enter a valid input.
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
                            <th class="text-center align-middle" style="width: 50px">
                                No.
                            </th>
                            <th class="text-center align-middle">
                                Nama Unit
                            </th>
                            <th class="text-center align-middle" style="width: 100px">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse($units as $unit)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $unit->nama_unit }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('master-unit.edit', $unit->id_unit) }}"
                                            class="btn btn-warning raised p-1"
                                            style="
														width: 30px;
														height: 30px;
													">
                                            <i class="material-icons-outlined" style="font-size: 16px">edit</i></a>
                                        <form action="{{ route('master-unit.destroy', $unit->id_unit) }}" method="POST"
                                            class="form-delete-unit" data-id="{{ $unit->id_unit }}"
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
                                <td colspan="7" class="text-center">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.form-delete-unit').forEach(function(form) {
                form.querySelector('.delete').addEventListener('click', function(e) {
                    e.preventDefault();
                    const unitId = form.getAttribute('data-id');

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
                        }
                    });
                });
            });

            @if (session('used_error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menghapus!',
                    text: '{{ session('used_error') }}',
                });
            @endif
        });
    </script>

    <!-- validasi input -->
    <script>
        const namaUnitInput = document.getElementById('nama_unit');
        const submitButton = document.querySelector('button[type="submit"]');

        function validateNamaUnit() {
            const namaUnitErrorDiv = document.getElementById('namaunit-error');
            let isValid = true;

            if (namaUnitInput.value.startsWith(' ')) {
                namaUnitErrorDiv.textContent = 'Nama Unit tidak boleh diawali dengan spasi.';
                namaUnitInput.classList.add('is-invalid');
                isValid = false;
            } else {
                namaUnitErrorDiv.textContent = '';
                namaUnitInput.classList.remove('is-invalid');
            }

            // Nonaktifkan tombol submit jika ada error
            submitButton.disabled = !isValid;
        }
        namaUnitInput.addEventListener('input', validateNamaUnit);
    </script>
@endsection
