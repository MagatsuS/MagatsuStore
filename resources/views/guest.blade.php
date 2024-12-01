<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MagatsuStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script> <!-- GSAP library -->
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; top: 0; left: 0; width: 100%;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('guest') }}">
                <strong>MagatsuStore</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-dark text-white text-center py-5" style="margin-top: 30px;">
        <h1>Welcome to MagatsuStore</h1>
        <p>Your one-stop shop for amazing products</p>
        <a href="#products" class="btn btn-primary">Shop Now</a>
    </header>

    <!-- Product Images Scrolling Section -->
    <section id="product-images" class="container my-5">
        <h2 class="text-center mb-4">Featured Products</h2>
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
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top fixed-image-size" alt="{{ $product->name }}"/>
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->formatted_price }}</p>
                                <a href="{{ route('productGuest', $product->id) }}" class="btn btn-primary">View product</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3" style="position: fixed; bottom: 0; left: 0; width: 100%;">
        <p class="mb-0">&copy; 2024 MagatsuStore. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS for interactivity (Optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // GSAP Animation for Horizontal Scrolling of Product Images
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
    /* Styling for the product images scrolling */
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

    .category-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .category-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .fixed-image-size {
        width: 100%; /* Make the image responsive to its container */
        height: 200px; /* Fixed height for all images */
        object-fit: cover; /* Crop and center the image to fill the height */
    }
</style>

