@extends('layouts.appUser')

@section('content')
    <!-- Main Content -->
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-top: 70px;">
        <div class="col-md-6">
            <h3 class="text-center mb-4">Edit Profile</h3>
            
            <!-- Display success message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- Edit Profile Form -->
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT') <!-- Use PUT method for updating -->
                
                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Profile</button>
            </form>

            <!-- Button to Show Delivery Address -->
            <div class="text-center mt-3">
                <a href="{{ route('address.show') }}" class="btn btn-primary w-100">Delivery Address</a>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-3">
                <a href="{{ route('user') }}" class="btn btn-secondary w-100">Back</a>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3" style="position: fixed; bottom: 0; left: 0; width: 100%;">
        <p class="mb-0">&copy; 2024 MagatsuStore. All rights reserved.</p>
    </footer>
@endsection
