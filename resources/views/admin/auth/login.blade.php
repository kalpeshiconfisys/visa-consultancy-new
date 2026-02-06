<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Visa Consultancy - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/visa-logo.webp') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        /* ===========================
           GLOBAL
        ============================ */


        .btn-login {
  background-color: #263B27;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
  border: none;
  transition: all 0.2s ease;
}

.btn-login:hover {
  background-color: #2f4a31;
  box-shadow: 0 6px 14px rgba(0, 0, 0, 0.35);
  transform: translateY(-1px);
}

.btn-login:active {
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
  transform: translateY(0);
}




        body {
            font-family: 'Segoe UI', sans-serif;
            overflow: hidden;
        }

        .login-card {
            animation: slideFade 0.8s ease forwards;
        }

        @keyframes slideFade {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card img {
            animation: pulse 3s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.08);
            }
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
        }

        /* ===========================
           BUTTON
        ============================ */
        

        .btn-login:hover::after {
            opacity: 1;
        }

        /* ===========================
           RIGHT IMAGE
        ============================ */
        .login-bg {
            position: relative;
            animation: zoomBg 12s infinite alternate ease-in-out;
        }

        @keyframes zoomBg {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.08);
            }
        }

        .login-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(2, 6, 23, 0.6), rgba(15, 23, 42, 0.3));
        }

        /* ===========================
           TOAST
        ============================ */
        .custom-alert {
            animation: toastSlide 0.5s ease forwards;
        }

        @keyframes toastSlide {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* ===========================
           FOOTER TEXT
        ============================ */
        .footer-text {
            opacity: 0.7;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Toast Alerts -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
        @if (session('success'))
            <div class="toast show bg-success text-white custom-alert">
                <div class="d-flex">
                    <div class="toast-body">{{ session('success') }}</div>
                    <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="toast show bg-danger text-white custom-alert">
                <div class="d-flex">
                    <div class="toast-body">{{ session('error') }}</div>
                    <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        @endif
    </div>

    <div class="container-fluid vh-100">
        <div class="row h-100">

            <!-- LEFT LOGIN -->
            <div class="col-lg-6 col-md-7 d-flex align-items-center justify-content-center bg-white">
                <div class="w-75 login-card">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/visa-logo1.png') }}" width="90">
                    </div>
                    <h3 class="text-center fw-bold mb-2">Login to Your Visa Portal</h3>
                    <p class="text-center text-muted mb-4">
                        Secure access to applications, documents and appointments.
                    </p>
                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control"
                                placeholder="admin@visaconsultancy.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="••••••••" required>
                        </div>

                       <button class="btn btn-login w-100 py-2 mt-2 text-white">
                        <i class="fa-solid fa-lock me-1"></i> Secure Login
                        </button>

                    </form>

                    <div class="text-center mt-4 small footer-text">
                        © Global Visa Consultancy — Making Your Dreams Fly ✈
                    </div>
                </div>
            </div>
            <!-- RIGHT IMAGE -->
            <div class="col-lg-6 col-md-5 d-none d-md-block p-0">
                <div class="h-100 login-bg"
                    style="background:url('{{ asset('assets/images/background/hire-visa-consultant.jpg') }}') center/cover no-repeat;">
                </div>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $('.toast').fadeOut(600);
            }, 3500);
        });
    </script>
</body>
</html>
