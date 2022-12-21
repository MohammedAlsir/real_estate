<?php

namespace App\Http\Livewire;

use App\Models\Apartment;
use Livewire\Component;

class ApartmentType extends Component
{
    public $selectType;
    public $rental;
    public $rental_type;
    public $price;

    public function render()
    {
        return view('livewire.apartment-type');
    }

    public function mount($apartment_id)
    {
        if ($apartment_id != '') {
            $this->selectType = Apartment::find($apartment_id)->type;
            $this->rental = Apartment::find($apartment_id)->rental;
            $this->rental_type = Apartment::find($apartment_id)->rental_type;
            $this->price = Apartment::find($apartment_id)->price;
        }
    }
}