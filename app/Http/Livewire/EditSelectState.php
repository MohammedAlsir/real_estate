<?php

namespace App\Http\Livewire;

use App\Models\Apartment;
use App\Models\City;
use App\Models\Hotel;
use App\Models\House;
use App\Models\Parcel;
use App\Models\State;
use Livewire\Component;

class EditSelectState extends Component
{
    public $city;
    public $selectedState = Null;
    public $selectedCity = Null;

    public function render()
    {
        $all_states = State::all();
        return view('livewire.edit-select-state', compact('all_states'));
    }

    public function mount($model, $item_id)
    {
        if ($model == "House") {
            $state_id = House::find($item_id)->city->state_id;
            $this->selectedCity = House::find($item_id)->city_id;
        } //
        elseif ($model == "Parcel") {
            $state_id = Parcel::find($item_id)->city->state_id;
            $this->selectedCity = Parcel::find($item_id)->city_id;
        } elseif ($model == "Apartment") {
            $state_id = Apartment::find($item_id)->city->state_id;
            $this->selectedCity = Apartment::find($item_id)->city_id;
        } elseif ($model == "hotels") {
            $state_id = Hotel::find($item_id)->city->state_id;
            $this->selectedCity = Hotel::find($item_id)->city_id;
        }

        $this->city = City::where('state_id', $state_id)->get();

        $this->selectedState = $state_id;
    }

    public function updatedSelectedState($id)
    {
        if (!is_null($id)) {
            $this->city = City::where('state_id', $id)->get();
        }
    }
}