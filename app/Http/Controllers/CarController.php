<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Make;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    public function showForm()
    {
        $categories = Category::all();
        $makes = Make::all();
        $models = VehicleModel::all();
        return view('livewire.pages.front-end.create-car', compact('models', 'makes', 'categories'));  // Show the form
    }

    public function store(Request $request)
    {
        // Handle form submission and validation
        $validated = $request->validate([
            'reason' => 'required|string',
            'category_id' => 'required|string',
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
            'description' => 'required|string',
            'vehicle_images' => 'required',
        ]);

        DB::beginTransaction();
        try {

            // Create the vehicle record
            $vehicle = Vehicle::create($validated + ['account_number' => $this->generateAccountNumber()]);

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


    public function generateAccountNumber()
    {
        // Get the latest user account number
        $latestAccountNumber = Vehicle::latest('id')->first();

        // Extract the numeric part and increment it
        if ($latestAccountNumber) {
            $lastNumber = (int)substr($latestAccountNumber->account_number, 3); // Assuming 'MSA' is the prefix
            $newNumber = $lastNumber + 1;
        } else {
            // If there are no vehicles, start from 1
            $newNumber = 1;
        }

        // Ensure the total length (prefix + numeric part) is 6 digits
        $numericPart = str_pad($newNumber, 3, '0', STR_PAD_LEFT); // Padding only the numeric part to 3 digits
        $accountNumber = 'MSA' . $numericPart;

        // Ensure the account number is unique
        while (Vehicle::where('account_number', $accountNumber)->exists()) {
            $newNumber++;
            $numericPart = str_pad($newNumber, 3, '0', STR_PAD_LEFT); // Re-pad if the number changes
            $accountNumber = 'MSA' . $numericPart;
        }

        return $accountNumber;
    }


    public function showEditForm(Vehicle $vehicle)
    {
        $categories = Category::all();
        $models = VehicleModel::all();
        $makes = Make::all();
        return view('livewire.pages.front-end.edit-car', compact('vehicle', 'makes', 'models', 'categories'));
    }


    public function update(Request $request, Vehicle $vehicle)
    {
        // Handle form submission and validation
        $validated = $request->validate([
            'reason' => 'required|string',
            'category_id' => 'required|string',
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
            'description' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            // Create the vehicle record
            $vehicle->update($validated);

            if (!empty($request->vehicle_images)) {

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

                        Image::where('vehicle_id', $vehicle->id)->delete();

                        // Store the image path in the database
                        Image::create([
                            'vehicle_id' => $vehicle->id,
                            'image_url' => 'vehicle_images/' . $imageName, // Corrected path
                        ]);
                    } else {
                        Log::error("Failed to move image: $imageName");
                    }
                }
            }


            DB::commit();  // Commit the transaction
            session()->flash('success', 'Your vehicle has been updated successfully!');
            return redirect()->route('front-end.edit-car', $vehicle->id);

        } catch (Exception $e) {
            DB::rollBack();  // Rollback the transaction
            session()->flash('error', 'There was an error while updating the vehicle!');
            return redirect()->route('front-end.edit-car', $vehicle->id)->withErrors(['error' => 'There was an error while updating the vehicle!']);
        }
    }

}
