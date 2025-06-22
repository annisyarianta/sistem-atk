@extends('layouts.app')

@section('title')
    Master Data ATK | ATK Inventory System
@endsection

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h3 class="mb-0 text-uppercase fw-bold">Master Data ATK</h3>
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
                                Tambah Data ATK
                            </h5>
                            <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                <i class="material-icons-outlined text-light">close</i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="form-body">
                                <form action="{{ route('master-atk.store') }}" method="POST" enctype="multipart/form-data"
                                    class="row g-3 needs-validation" novalidate>
                                    @csrf
                                    <div class="col-md-12">
                                        <label for="nama_atk" class="form-label">Nama ATK</label>
                                        <input type="text" name="nama_atk" class="form-control" id="nama_atk"
                                            placeholder="Masukkan nama ATK" value="{{ old('nama_atk') }}" required>
                                        <div class="invalid-feedback" id="namaatk-error">Please enter a valid input.</div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="kode_atk" class="form-label">Kode ATK</label>
                                        <input type="text" name="kode_atk"
                                            class="form-control @error('kode_atk') is-invalid @enderror"
                                            value="{{ old('kode_atk') }}" id="kode_atk" placeholder="Masukkan kode ATK"
                                            required>
                                        <div class="invalid-feedback">
                                            @error('kode_atk')
                                                {{ $message }}
                                            @else
                                                Please enter a valid input.
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="jenis_atk" class="form-label">Jenis ATK</label>
                                        <select name="jenis_atk" id="jenis_atk" class="form-select form-control"
                                            value="{{ old('jenis_atk') }}" required>
                                            <option disabled selected value="">--- Pilih jenis ATK ---
                                            </option>
                                            <option value="habis_pakai">Habis Pakai</option>
                                            <option value="tidak_habis_pakai">Tidak Habis Pakai</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please choose one.
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="satuan" class="form-label">Satuan</label>
                                        <input type="text" name="satuan" class="form-control" id="satuan"
                                            placeholder="Masukkan satuan" value="{{ old('satuan') }}" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid input.
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="jumlah_minimum" class="form-label">Jumlah Minimum</label>
                                        <input type="number" name="jumlah_minimum" class="form-control" id="jumlah_minimum"
                                            placeholder="Masukkan jumlah minimum" value="{{ old('jumlah_minimum') }}" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid number.
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="gambar_atk" class="form-label">Gambar ATK</label>
                                        <input class="form-control" type="file" name="gambar_atk" id="gambar_atk">
                                        <small>Upload gambar jika ada (.jpg, *.jpeg, *.png), maks. 5 MB</small>
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
                            <th class="text-center align-middle" style="width: 320px">
                                Nama ATK
                            </th>
                            <th class="text-center align-middle" style="width: 130px">
                                Jenis ATK
                            </th>
                            <th class="text-center align-middle">
                                Satuan
                            </th>
                            <th class="text-center align-middle">
                                Jumlah Minimum
                            </th>
                            <th class="text-center align-middle" style="width: 170px">
                                Gambar
                            </th>
                            <th class="text-center align-middle" style="width: 90px">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse($data as $atk)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
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
                                <td class="text-center">{{ $atk->satuan }}</td>
                                <td class="text-center">{{ $atk->jumlah_minimum }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-content-center p-1">
                                        <img src="{{ $atk->gambar_atk ? asset('storage/' . $atk->gambar_atk) : asset('images/logo-injourney-airport.png') }}"
                                            alt="Gambar ATK" style="max-width: 150px; max-height: 180px;">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('master-atk.edit', $atk) }}"
                                            class="btn btn-warning raised p-1"
                                            style="
														width: 30px;
														height: 30px;
													">
                                            <i class="material-icons-outlined" style="font-size: 16px">edit</i></a>
                                        <form action="{{ route('master-atk.destroy', $atk->id_atk) }}" method="POST"
                                            class="form-delete-atk" data-id="{{ $atk->id_atk }}"
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
            document.querySelectorAll('.form-delete-atk').forEach(function(form) {
                form.querySelector('.delete').addEventListener('click', function(e) {
                    e.preventDefault();
                    const atkId = form.getAttribute('data-id');

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
                            fetch(`/master-atk/check-used/${atkId}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.can_delete) {
                                        form.submit();
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal Menghapus!',
                                            text: 'Data ATK ini tidak dapat dihapus karena masih digunakan.'
                                        });
                                    }
                                })
                                .catch(() => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terjadi Kesalahan',
                                        text: 'Gagal menghubungi server.'
                                    });
                                });
                        }
                    });
                });
            });
        });
    </script>

    <!-- validasi input -->
    <script>
        const namaAtkInput = document.getElementById('nama_atk');
        const submitButton = document.querySelector('button[type="submit"]');

        function validateNamaAtk() {
            const namaAtkErrorDiv = document.getElementById('namaatk-error');
            let isValid = true;

            if (namaAtkInput.value.startsWith(' ')) {
                namaAtkErrorDiv.textContent = 'Nama ATK tidak boleh diawali dengan spasi.';
                namaAtkInput.classList.add('is-invalid');
                isValid = false;
            } else {
                namaAtkErrorDiv.textContent = '';
                namaAtkInput.classList.remove('is-invalid');
            }

            // Nonaktifkan tombol submit jika ada error
            submitButton.disabled = !isValid;
        }
        namaAtkInput.addEventListener('input', validateNamaAtk);
    </script>
@endsection
