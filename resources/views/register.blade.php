<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MagatsuStore</title>
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
            <h3 class="text-center mb-4">Create an Account</h3>
            
            <!-- Registration Form -->
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">User name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Register</button>

                <div class="text-center mt-3">
                    <p>Already have an account? <a href="{{ route('login') }}">Login here</a>.</p>
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