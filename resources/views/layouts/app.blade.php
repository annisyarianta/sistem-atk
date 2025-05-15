<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('images/logo-injourney.png') }}" type="image/png" />

    <!--plugins-->
    <link rel="stylesheet" href="{{ asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/metismenu/mm-vertical.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/notifications/css/lobibox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--bootstrap css-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatable/css/dataTables.bootstrap5.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet" />
    <!--main css-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-extended.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body>

    @include('layouts.navigation') 

    <!--start main wrapper-->
    <main class="main-wrapper">
        <div class="main-content">
            @yield('content')
        </div>
    </main>
    <!--end main wrapper-->

    <!--start overlay-->
    <div class="overlay btn-toggle"></div>
    <!--end overlay-->

    <!--start footer-->
    <footer class="page-footer">
        <p class="mb-0">
            Copyright © InJourney Radin Inten II Airport 2025
        </p>
    </footer>
    <!--top footer-->

    <!--start cart-->

    <!--end cart-->

    <!--bootstrap js-->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
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
    <script src="{{ asset('plugins/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/validation/validation-script.js') }}"></script>
    <script>
        (function() {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <script src="{{ asset('plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
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
            if (!event.target.matches('#searchInput') && !event.target.matches('.dropdown-content a')) {
                document.getElementById("dropdownList").style.display = "none";
            }
        }

        // Menampilkan dropdown saat input aktif
        document.getElementById("searchInput").onclick = function() {
            document.getElementById("dropdownList").style.display = "block";
        }
    </script>
    <!--notification js -->
    <script src="{{ asset('plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('plugins/notifications/js/notification-custom-script.js') }}"></script>
    <style>
        /* Styling untuk dropdown custom */
        .searchable-dropdown {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding-right: 30px;
        }

        .dropdown-arrow {
            position: absolute;
            right: 35px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            color: #B0B0B0;
            pointer-events: none;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 100%;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            max-height: 200px;
            overflow-y: auto;
        }

        .dropdown-content a {
            color: #343a40;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }
    </style>
    <!-- Sweet alert init js-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const href = this.getAttribute('href');

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
                        window.location.href = href;
                    }
                });
            });
        });
    </script>

</body>

</html>
