<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $address = $user->addresses()->first();  // Retrieve the first address, adjust as needed
    
        return view('address.show', compact('address'));
    }     

    public function create()
    {
        return view('address.create');  // Make sure this matches the file path
    }

    public function store(Request $request)
    {
        // Validate the address fields
        $validated = $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);
    
        // Save the address
        auth()->user()->addresses()->create([
            'address_line_1' => $validated['address_line_1'],
            'address_line_2' => $validated['address_line_2'] ?? null,
            'city' => $validated['city'],
            'state' => $validated['state'],
            'postal_code' => $validated['postal_code'],
        ]);
    
        // Redirect with a success message
        return redirect()->route('address.show')->with('success', 'Address added successfully.');
    }
    
    public function edit($id)
    {
        $address = Address::findOrFail($id);
        return view('address.edit', compact('address'));
    }

    public function destroy($id)
    {
        // Find the address by its ID
        $address = Address::findOrFail($id);

        // Delete the address
        $address->delete();

        // Redirect the user with a success message
        return redirect()->route('address.show')->with('success', 'Address deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the address fields
        $validated = $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);

        // Find the address by ID
        $address = Address::findOrFail($id);

        // Update the address with validated data
        $address->update($validated);

        // Redirect with success message
        return redirect()->route('address.show')->with('success', 'Address updated successfully.');
    }
}
