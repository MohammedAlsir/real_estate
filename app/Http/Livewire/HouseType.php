<?php

namespace App\Http\Livewire;

use App\Models\House;
use Livewire\Component;

class HouseType extends Component
{
    public $selectType;
    public $rental;
    public $price;


    public function render()
    {
        return view('livewire.house-type');
    }

    public function mount($house_id)
    {
        if ($house_id != '') {
            $this->selectType = House::find($house_id)->type;
            $this->rental = House::find($house_id)->rental;
            $this->price = House::find($house_id)->price;
        }
    }
}
