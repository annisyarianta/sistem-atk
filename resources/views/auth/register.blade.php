<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register Staff | ATK Inventory System</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('images/logo-injourney.png') }}" type="image/png" />

    <!--plugins-->
    <link rel="stylesheet" href="{{ asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/metismenu/mm-vertical.css') }}">
    <!--bootstrap css-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet" />
    <!--main css-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-extended.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        body {
            background: linear-gradient(135deg,
                    #e0f7ff,
                    #ffe8d6);
            background-attachment: fixed;
            background-size: cover;
            position: relative;
            overflow-x: hidden;
        }

        .login-bg-wrapper {
            background-image: url("{{ asset('images/login-bg.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
            min-height: 100%;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
            position: relative;
            overflow: hidden;
        }

        .login-bg-wrapper::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(rgba(0, 123, 255, 0.35),
                    rgba(255, 140, 0, 0.2));
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        .col-lg-6.d-lg-flex {
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="mx-3 mx-lg-0 pt-lg-4">
        <div class="card my-5 col-xl-9 col-xxl-8 mx-auto rounded-4 overflow-hidden">
            <div class="row g-0">
                <div class="col-lg-6 d-flex py-4 px-4">
                    <div class="card-body">
                        <img src="{{ asset('images/logo-injourney-airport.png') }}" class="mb-4 d-block mx-auto ms-lg-0"
                            width="145" alt="" />
                        <p class="mb-4 text-center">
                            Selamat Datang di <br />
                            <strong>Sistem Manajemen ATK Bandara Radin Inten
                                II</strong>
                        </p>
                        <h4 class="fw-bold text-center">REGISTER STAFF</h4>
                        @if (session('status'))
                            <div class="mb-4 text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-body mt-4">
                            <form method="POST" action="{{ route('register') }}" class="row g-3">
                                @csrf
                                <!-- Nama -->
                                <div class="col-12">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" placeholder="Masukkan nama anda" />
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Unit -->
                                <div class="col-12">
                                    <label for="id_unit" class="form-label">Unit</label>
                                    <select id="id_unit" name="id_unit"
                                        class="form-select form-control @error('id_unit') is-invalid @enderror">
                                        <option disabled selected value="">
                                            --- Pilih unit ---
                                        </option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id_unit }}">{{ $unit->nama_unit }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_unit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Email -->
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Masukkan email anda" />
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Password -->
                                <div class="col-12">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group @error('password') is-invalid @enderror"
                                        id="show_hide_password">
                                        <input type="password"
                                            class="form-control border-end-0 @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Masukkan password anda" />
                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                class="bi bi-eye-slash-fill"></i></a>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Confirm Password -->
                                <div class="col-12 mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0"
                                            id="password_confirmation" name="password_confirmation"
                                            placeholder="Masukkan kembali password anda" />
                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                class="bi bi-eye-slash-fill"></i></a>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-grd-info text-light">
                                            Daftar
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-center">
                                        <p class="mb-0">
                                            Sudah punya akun?
                                            <a href="{{ route('login') }}">Login</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex d-none">
                    <div class="login-bg-wrapper w-100 rounded-4 d-flex align-items-center justify-content-center">
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>

    <!--plugins-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on("click", function(event) {
                event.preventDefault();
                if ($("#show_hide_password input").attr("type") == "text") {
                    $("#show_hide_password input").attr("type", "password");
                    $("#show_hide_password i").addClass(
                        "bi-eye-slash-fill",
                    );
                    $("#show_hide_password i").removeClass("bi-eye-fill");
                } else if (
                    $("#show_hide_password input").attr("type") ==
                    "password"
                ) {
                    $("#show_hide_password input").attr("type", "text");
                    $("#show_hide_password i").removeClass(
                        "bi-eye-slash-fill",
                    );
                    $("#show_hide_password i").addClass("bi-eye-fill");
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("password_confirmation");

            function showError() {
                confirmPassword.classList.add("is-invalid");

                const existingFeedback = confirmPassword.parentElement.querySelector(".invalid-feedback");
                if (!existingFeedback) {
                    const feedback = document.createElement("div");
                    feedback.classList.add("invalid-feedback");
                    feedback.innerText = "Konfirmasi password harus sama dengan password.";
                    confirmPassword.parentElement.appendChild(feedback);
                }
            }

            function removeError() {
                confirmPassword.classList.remove("is-invalid");

                const feedback = confirmPassword.parentElement.querySelector(".invalid-feedback");
                if (feedback) feedback.remove();
            }

            function validatePasswordMatch() {
                if (confirmPassword.value && password.value !== confirmPassword.value) {
                    showError();
                } else {
                    removeError();
                }
            }

            password.addEventListener("input", validatePasswordMatch);
            confirmPassword.addEventListener("input", validatePasswordMatch);

            form.addEventListener("submit", function(e) {
                removeError();
                if (password.value !== confirmPassword.value) {
                    e.preventDefault();
                    showError();
                    confirmPassword.focus();
                }
            });
        });
    </script>

</body>

</html>
