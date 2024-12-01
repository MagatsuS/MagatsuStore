@extends('layouts.appUser')

@section('content')
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-top: 70px;">
        <div class="col-md-6">
            <h3 class="text-center mb-4">Delivery Address</h3>

            @if($address)
                <!-- Card to display the address -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Your Address</h5>
                        <p class="card-text">
                            <strong>Address Line 1:</strong> {{ $address->address_line_1 }} <br>
                            @if($address->address_line_2) 
                                <strong>Address Line 2:</strong> {{ $address->address_line_2 }} <br>
                            @endif
                            <strong>City:</strong> {{ $address->city }} <br>
                            <strong>State:</strong> {{ $address->state }} <br>
                            <strong>Postal Code:</strong> {{ $address->postal_code }} <br>
                        </p>
                        
                        <!-- Edit Address Button -->
                        <div class="text-center mt-3">
                            <a href="{{ route('address.edit', $address->id) }}" class="btn btn-warning w-100">Edit Address</a>
                        </div>

                        <!-- Delete Address Button -->
                        <div class="text-center mt-3">
                            <!-- Form for delete action -->
                            <form action="{{ route('address.destroy', $address->id) }}" method="POST">
                                @csrf
                                @method('DELETE') <!-- This will make it a DELETE request -->
                                <button type="submit" class="btn btn-danger w-100">Delete Address</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <p>No address found. Please add one.</p>
            @endif

            <!-- Add Address Button only if no address exists -->
            @if(!$address)
                <div class="text-center mt-3">
                    <a href="{{ route('address.create') }}" class="btn btn-primary w-100">Add Address</a>
                </div>
            @endif

            <!-- Back Button with spacing -->
            <div class="text-center mt-3"> <!-- Add mt-3 or any other margin utility for spacing -->
                <a href="{{ route('user.profile') }}" class="btn btn-secondary w-100">Back to Profile</a>
            </div>
        </div>
    </div>
@endsection
