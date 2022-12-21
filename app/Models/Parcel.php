<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function type()
    {
        return $this->belongsTo(ParcelType::class, 'parcel_type_id');
    }

    public function category()
    {
        return $this->belongsTo(ParcelCategory::class, 'parcel_category_id');
    }

    public function spaceType()
    {
        return $this->belongsTo(SpaceType::class, 'space_type_id');
    }
}