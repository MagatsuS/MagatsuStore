<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MagatsuStore Dashboard')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <!-- Include a Navbar for Owner -->
    @include('partials.navbarOwner') <!-- Assuming navbarOwner.blade.php exists -->

    <!-- Main Content -->
    <main class="container my-5">
        @yield('content') <!-- This is where the page-specific content will be inserted -->
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Idle Timeout Script -->
    <script>
        let timeout;

        // Set the timeout duration (in milliseconds) — 1 hour (60 minutes * 60 seconds * 1000 ms)
        const idleTimeLimit = 60 * 60 * 1000;

        // Reset the timeout whenever the user moves the mouse, presses any key, or clicks anywhere
        function resetIdleTimer() {
            clearTimeout(timeout);
            timeout = setTimeout(logout, idleTimeLimit);
        }

        // Logout the user after idle time limit has been reached
        function logout() {
            window.location.href = "{{ route('logout') }}"; // Redirect to logout route
        }

        // Add event listeners to track user activity
        window.onload = function() {
            document.body.addEventListener('mousemove', resetIdleTimer);
            document.body.addEventListener('keydown', resetIdleTimer);
            document.body.addEventListener('click', resetIdleTimer);

            // Initialize the idle timer
            resetIdleTimer();
        };
    </script>
</body>
</html>
