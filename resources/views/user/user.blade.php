<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - MagatsuStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script> <!-- GSAP library -->
</head>
<body>

    <!-- Navbar -->
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

    <!-- Header Section -->
    <header class="bg-dark text-white text-center py-5" style="margin-top: 10px;">
        <h1>Welcome to MagatsuStore</h1>
        <p>Your one-stop shop for amazing products</p>
        <a href="#products" class="btn btn-primary">Shop Now</a>
    </header>

    <!-- Product Images Scrolling Section -->
    <section id="product-images" class="container my-5">
        <h2 class="text-center mb-4">Our Products</h2>
        <div class="d-flex overflow-hidden">
            <div class="d-flex flex-nowrap" id="image-scroll-container">
                @foreach ($products as $product)
                    <div class="mx-2">
                        <img src="{{ asset('storage/' . $product->image) }}" class="product-image" alt="{{ $product->name }}">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Product Listings Section -->
    <section id="products" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Featured Products</h2>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm rounded" style="transition: transform 0.2s;">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top fixed-image-size" alt="{{ $product->name }}">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->formatted_price }}</p>
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View product</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; 2024 MagatsuStore. All rights reserved.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // GSAP Animation for Horizontal Scrolling
        var tl = gsap.timeline({
            defaults: {
                ease: "linear",
                repeat: -1 // Infinite loop
            }
        });

        // Scroll the images horizontally
        tl.fromTo(
            "#image-scroll-container",
            { x: "100%" },
            {
                x: "-100%",
                duration: 20, // Duration of the scroll
            }
        );
    </script>

</body>
</html>

<style>
    /* Ensure the product images are aligned in a row and have fixed size */
    .product-image {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* Container to hide overflow and allow scrolling */
    #product-images {
        position: relative;
        overflow: hidden;
    }

    /* Make sure the images are in a horizontal row and don't wrap */
    #image-scroll-container {
        display: flex;
        flex-wrap: nowrap;
    }

    /* Ensure the product images are aligned within cards and have the same size */
    .fixed-image-size {
        width: 100%;           /* Use full width of the card */
        height: 200px;         /* Set a fixed height */
        object-fit: cover;     /* Ensure the image doesn't stretch */
        border-radius: 8px;    /* Optional: rounded corners */
    }
</style>
