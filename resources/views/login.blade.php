<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MagatsuStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar (Optional) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; top: 0; left: 0; width: 100%;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('guest') }}">
                <strong>MagatsuStore</strong>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-top: 70px;">
        <div class="col-md-6">
            <h3 class="text-center mb-4">Login to MagatsuStore</h3>

            <!-- Display success message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display error messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Login Form -->
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>

                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a>.</p>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3" style="position: fixed; bottom: 0; left: 0; width: 100%;">
        <p class="mb-0">&copy; 2024 MagatsuStore. All rights reserved.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
