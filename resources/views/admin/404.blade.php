<!DOCTYPE html>
<html lang="en">
<head>
    <title>404 | Page Not Found</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page not found">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8f9fa, #eef2f7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .error-wrapper {
            max-width: 600px;
            width: 100%;
            padding: 20px;
        }

        .error-card {
            background: #fff;
            border-radius: 18px;
            padding: 50px 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            text-align: center;
            animation: fadeUp 0.8s ease-in-out;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-code {
            font-size: 96px;
            font-weight: 800;
            color: #0d6efd;
            line-height: 1;
        }

        .error-title {
            font-size: 28px;
            margin-top: 10px;
            font-weight: 600;
        }

        .error-desc {
            color: #6c757d;
            margin: 20px 0 35px;
            font-size: 16px;
        }

        .btn-home {
            padding: 12px 28px;
            font-size: 16px;
            border-radius: 50px;
        }

        .brand-logo img {
            max-height: 70px;
            margin-bottom: 30px;
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 13px;
            color: #adb5bd;
        }

        .custom-theme-color {
            color: #263B27  !important;

}

    </style>
</head>

<body>

<div class="error-wrapper">

    <div class="error-card">

        <!-- Logo -->
        <div class="brand-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/images/visa-logo1.png') }}" alt="Visa Consultancy">
            </a>
        </div>

        <!-- Error -->
        <div class="error-code custom-theme-color ">404</div>
        <div class="error-title">Page Not Found</div>
        <p class="error-desc">
            The page you are looking for might have been removed,
            had its name changed, or is temporarily unavailable.
        </p>

        <!-- Action -->
        <a href="{{ url('/') }}" class="btn  custom-theme-color  btn-home" style="background-color: #263B27 ; color:#fff;">
            <i class="fas fa-home me-2"></i>Back to Home
        </a>

    </div>

    <!-- Footer -->
    <footer>
        Designed with <i class="fas fa-heart text-danger"></i> by Your Company
    </footer>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
