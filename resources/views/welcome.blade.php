<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM System</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="container text-center">
        <div class="card shadow-lg border-0 mx-auto" style="max-width: 500px;">
            <div class="card-header bg-dark text-white">
                <h3 class="mb-0">Welcome to CRM System</h3>
            </div>

            <div class="card-body">
                <p class="text-muted mb-4">
                    Manage your customers, conversations, and messages efficiently in one place.
                </p>

                <div class="d-grid gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-success btn-lg">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <div class="card-footer text-center text-muted small">
                <p class="mb-0">&copy; {{ date('Y') }} CRM System. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
