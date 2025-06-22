@extends('layouts.app')

@section('title')
    Kelola User | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase">Daftar User</h3>
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
                                Tambah Data User
                            </h5>
                            <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                <i class="material-icons-outlined text-light">close</i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="form-body">
                                <form action="{{ route('kelola-user.store') }}" method="POST" enctype="multipart/form-data"
                                    class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div class="col-md-12">
                                        <label for="role" class="form-label">Role</label>
                                        <select name="role" id="role"
                                            class="form-select form-control @error('role') is-invalid @enderror" required>
                                            <option disabled {{ old('role') ? '' : 'selected' }} value="">--- Pilih
                                                Role ---
                                            </option>
                                            <option value="admin">Admin</option>
                                            <option value="staff">Staff</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please choose one.
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="id_unit" class="form-label">Unit</label>
                                        <select name="id_unit" id="id_unit"
                                            class="form-select @error('id_unit') is-invalid @enderror" required>
                                            <option disabled {{ old('id_unit') ? '' : 'selected' }} value="">
                                                --- Pilih Unit ---
                                            </option>
                                            @foreach ($masterUnit as $unit)
                                                <option value="{{ $unit->id_unit }}"
                                                    {{ old('id_unit') == $unit->id_unit ? 'selected' : '' }}>
                                                    {{ $unit->nama_unit }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please choose one.
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="nama"
                                            placeholder="Masukkan nama pengguna" value="{{ old('nama') }}" required>
                                        <div class="invalid-feedback" id="nama-error">Please enter a valid name.</div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" id="email" placeholder="Masukkan email pengguna"
                                            required>
                                        <div class="invalid-feedback">
                                            @error('email')
                                                {{ $message }}
                                            @else
                                                Please enter a valid email.
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="text" name="password" class="form-control" id="password"
                                            placeholder="Masukkan kata sandi" value="{{ old('password') }}" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid password.
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
                            <th class="text-center align-middle" style="width: 200px">
                                Nama
                            </th>
                            <th class="text-center align-middle" style="width: 200px">
                                Email
                            </th>
                            <th class="text-center align-middle" style="width: 100px">
                                Role
                            </th>
                            <th class="text-center align-middle">
                                Unit
                            </th>
                            <th class="text-center align-middle">
                                Updated at
                            </th>
                            <th class="text-center align-middle" style="width: 90px">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $user->nama }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">
                                    @if ($user->role == 'admin')
                                        <span class="badge rounded-pill bg-grd-info">Admin</span>
                                    @elseif($user->role == 'staff')
                                        <span class="badge rounded-pill bg-grd-primary">Staff</span>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-grd-royal">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $user->unit->nama_unit ?? '-' }}</td>
                                <td class="text-center">{{ $user->updated_at }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        @if (!in_array($user->email, $protectedEmails))
                                            <a href="{{ route('kelola-user.edit', $user->id_user) }}"
                                                class="btn btn-warning raised p-1"
                                                style="
														width: 30px;
														height: 30px;
													">
                                                <i class="material-icons-outlined" style="font-size: 16px">edit</i></a>
                                            <form action="{{ route('kelola-user.destroy', $user->id_user) }}"
                                                method="POST" class="form-delete-user" data-id="{{ $user->id_user }}"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="btn delete btn-danger raised d-flex align-items-center justify-content-center p-1"
                                                    style="width: 30px; height: 30px;">
                                                    <i class="material-icons-outlined" style="font-size: 16px">delete</i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted"></span>
                                        @endif
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
            document.querySelectorAll('.form-delete-user').forEach(function(form) {
                form.querySelector('.delete').addEventListener('click', function(e) {
                    e.preventDefault();
                    const userId = form.getAttribute('data-id');

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

    <!-- validasi input -->
    <script>
        const namaInput = document.getElementById('nama');
        const submitButton = document.querySelector('button[type="submit"]');

        function validateNama() {
            const namaErrorDiv = document.getElementById('nama-error');
            let isValid = true;

            if (namaInput.value.startsWith(' ')) {
                namaErrorDiv.textContent = 'Nama pengguna tidak boleh diawali dengan spasi.';
                namaInput.classList.add('is-invalid');
                isValid = false;
            } else {
                namaErrorDiv.textContent = '';
                namaInput.classList.remove('is-invalid');
            }

            submitButton.disabled = !isValid;
        }
        namaInput.addEventListener('input', validateNama);
    </script>
@endsection
