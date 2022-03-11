<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inn extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function tours()
    {
        return $this->belongsToMany(Tour::class)
            ->as('kerupuk');
    }
}
