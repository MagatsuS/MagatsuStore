@extends('layouts.appUser')

@section('content')
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-top: 70px;">
        <div class="col-md-6">
            <h3 class="text-center mb-4">Add New Address</h3>

            <!-- Success or Error Message -->
            <div id="response-message" class="text-center mb-3"></div>

            <!-- Add Address Form -->
            <form id="address-form" action="{{ route('address.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="address_line_1" class="form-label">Address Line 1</label>
                    <input type="text" class="form-control" id="address_line_1" name="address_line_1" required>
                </div>

                <div class="mb-3">
                    <label for="address_line_2" class="form-label">Address Line 2 (Optional)</label>
                    <input type="text" class="form-control" id="address_line_2" name="address_line_2">
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>

                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" class="form-control" id="state" name="state" required>
                </div>

                <div class="mb-3">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Save Address</button>
            </form>
        </div>
    </div>

    @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('address-form');
            const responseMessage = document.getElementById('response-message');

            // Handle form submission via AJAX
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Clear previous messages
                responseMessage.innerHTML = '';

                // Create FormData object
                const formData = new FormData(form);

                // Send the form data using Fetch API
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Display success or error message
                    if (data.success) {
                        responseMessage.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                        form.reset(); // Reset form fields after successful submission
                    } else {
                        responseMessage.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                    }
                })
                .catch(error => {
                    responseMessage.innerHTML = `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
                });
            });
        });
    </script>

    <style>
        input {
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        button {
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
    @endsection
@endsection
