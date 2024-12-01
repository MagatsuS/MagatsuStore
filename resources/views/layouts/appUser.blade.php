<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MagatsuStore')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    @include('partials.navbarUser') <!-- Optional: include a navbar here if you have one -->

    <main class="container my-5">
        @yield('content')
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

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
        // Redirect the user to logout route or trigger a logout action
        window.location.href = "{{ route('logout') }}"; // Update with your logout route
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
