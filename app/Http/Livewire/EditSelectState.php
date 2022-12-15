<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Hotel;
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

    public function mount($parcel_id)
    {
        $state_id = Parcel::find($parcel_id)->city->state_id;
        $this->city = City::where('state_id', $state_id)->get();

        $this->selectedState = $state_id;
        $this->selectedCity = Parcel::find($parcel_id)->city_id;
    }

    public function updatedSelectedState($id)
    {
        if (!is_null($id)) {
            $this->city = City::where('state_id', $id)->get();
        }
    }
}