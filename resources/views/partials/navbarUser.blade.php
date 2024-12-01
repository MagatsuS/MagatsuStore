<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user') }}">
            <strong>MagatsuStore</strong>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @if(Auth::check()) <!-- Check if the user is authenticated -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">My Cart</a> <!-- Cart Button -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.userOrder') }}">My Order</a> <!-- Order Button -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.profile') }}">Profile</a> <!-- Profile Button -->
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a> <!-- Login Button -->
                    </li>
                @endif
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
