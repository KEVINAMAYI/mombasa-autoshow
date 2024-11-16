<?php

use App\Models\Make;
use App\Models\VehicleModel;
use Livewire\Volt\Component;

new class extends Component {

    public $makes = [];
    public $models = [];
    public $make_id = 1;
    public $vehicle_model_id = null;

    public function mount($vehicle)
    {
        $this->makes = Make::all();
        $this->make_id = old('make_id', $vehicle->make_id);

        $this->updateModels();
        $this->vehicle_model_id = old('vehicle_model_id', $vehicle->vehicle_model_id);

    }

    public function updateModels()
    {
        $this->models = VehicleModel::where('make_id', $this->make_id)->get();
    }


}; ?>

<div class="row">
    <!-- Make Dropdown -->
    <div class="col-md-6">
        <label for="make_id" class="form-label">Make</label>
        <select wire:model="make_id" wire:change="updateModels" name="make_id" id="make_id" class="form-select">
            @foreach($makes as $make)
                <option value="{{ $make->id }}">{{ $make->name }}</option>
            @endforeach
        </select>
        @error('make_id')
        <p class="text-danger text-xs pt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Model Dropdown -->
    <div class="col-md-6">
        <label for="vehicle_model_id" class="form-label">Model</label>
        <select wire:model="vehicle_model_id"  name="vehicle_model_id" id="vehicle_model_id" class="form-select" {{ empty($models) ? 'disabled' : '' }}>
            @foreach($models as $model)
                <option value="{{ $model->id }}">{{ $model->name }}</option>
            @endforeach
        </select>
        @error('vehicle_model_id')
        <p class="text-danger text-xs pt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

