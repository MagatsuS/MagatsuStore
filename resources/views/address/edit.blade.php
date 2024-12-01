@extends('layouts.appUser')

@section('content')
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-top: 70px;">
        <div class="col-md-6">
            <h3 class="text-center mb-4">Edit Delivery Address</h3>

            <!-- If there are any validation errors, show them -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form to edit the address -->
            <form action="{{ route('address.update', $address->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- This will make it a PUT request -->

                <div class="mb-3">
                    <label for="address_line_1" class="form-label">Address Line 1</label>
                    <input type="text" class="form-control" id="address_line_1" name="address_line_1" value="{{ old('address_line_1', $address->address_line_1) }}" required>
                </div>

                <div class="mb-3">
                    <label for="address_line_2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" id="address_line_2" name="address_line_2" value="{{ old('address_line_2', $address->address_line_2) }}">
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $address->city) }}" required>
                </div>

                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $address->state) }}" required>
                </div>

                <div class="mb-3">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code', $address->postal_code) }}" required>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary w-100">Update Address</button>
                </div>
            </form>

            <!-- Cancel Button (Back to show address page) -->
            <div class="text-center mt-3">
                <a href="{{ route('address.show') }}" class="btn btn-secondary w-100">Cancel</a>
            </div>
        </div>
    </div>
@endsection
