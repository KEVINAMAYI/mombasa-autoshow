<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    public function showForm()
    {
        return view('livewire.pages.front-end.create-car');  // Show the form
    }

    public function store(Request $request)
    {
        // Handle form submission and validation
        $validated = $request->validate([
            'reason' => 'required|string',
            'make_id' => 'required|string',
            'vehicle_model_id' => 'required|string',
            'manufacturing_year' => 'required',
            'location' => 'required|string',
            'eng_cc' => 'required',
            'transmission' => 'required|string',
            'fuel_type' => 'required|string',
            'interior_color' => 'required|string',
            'exterior_color' => 'required|string',
            'vehicle_reg' => 'required|string',
            'price' => 'required',
            'name' => 'required|string',
            'sacco' => 'required|string',
            'route' => 'required|string',
            'description' => 'required|string',
            'vehicle_images' => 'required',
        ]);

        DB::beginTransaction();

        try {

            // Create the vehicle record
            $vehicle = Vehicle::create($validated);

            // Ensure the public/vehicle_images directory exists
            $destinationPath = public_path('vehicle_images');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Loop through each image and store it
            foreach ($request->file('vehicle_images') as $image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Log the image path for debugging
                Log::info("Attempting to save image to: $destinationPath/$imageName");

                // Move the image to the public/vehicle_images directory
                $moved = $image->move($destinationPath, $imageName);

                if ($moved) {
                    // Log success
                    Log::info("Image successfully saved: vehicle_images/$imageName");

                    // Store the image path in the database
                    Image::create([
                        'vehicle_id' => $vehicle->id,
                        'image_url' => 'vehicle_images/' . $imageName, // Corrected path
                    ]);
                } else {
                    Log::error("Failed to move image: $imageName");
                }
            }

            DB::commit();  // Commit the transaction

            session()->flash('success', 'Your vehicle has been saved successfully!');
            return redirect()->route('front-end.create-car');

        } catch (Exception $e) {
            DB::rollBack();  // Rollback the transaction
            session()->flash('error', 'There was an error while saving the vehicle!');
            return redirect()->route('front-end.create-car')->withErrors(['error' => 'There was an error while saving the vehicle!']);
        }
    }
}
