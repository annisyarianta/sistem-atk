<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lupa Password | ATK Inventory System</title>
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
            overflow: hidden;
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
                        <img src="{{ asset('images/logo-injourney-airport.png') }}" class="mb-5" width="145"
                            alt="logo" />
                        <h4 class="fw-bold text-center">Lupa Kata Sandi?</h4>
                        <p class="mb-5 text-center">
                            Masukkan email Anda untuk mengatur ulang kata
                            sandi </p>
                        @if (session('status'))
                            <div class="mb-4 text-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-body">
                            <form class="row g-3" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="col-12 mb-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" id="email" name="email"
                                        placeholder="Masukkan email anda" />
                                    <div class="invalid-feedback">
                                        @error('email')
                                            {{ $message }}
                                        @else
                                            Please enter a valid input.
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-grd-warning text-light">
                                            Kirim Tautan Reset Kata Sandi
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="text-center">
                                        <p class="mb-0">
                                            Sudah ingat kata sandi Anda?
                                            <a href="{{ route('login') }}">Masuk di sini</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex d-none">
                    <div class="p-3 rounded-4 w-100 d-flex align-items-center justify-content-center bg-grd-warning">
                        <img src="{{ asset('images/forgot-password1.png') }}" class="img-fluid" alt="" />
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
</body>

</html>
