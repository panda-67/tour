<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_travel', 'travel_id', 'tour_id');
    }
}
