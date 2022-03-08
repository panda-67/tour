<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory; 

    protected $fillable = [
        'name',
        'user_id'
    ]; 

    protected $hidden = [
        // 'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }  
    
    // public function inns ()
    // {
    //     return $this->hasMany(Inn::class, 'tour_id');
    // }

    public function inns()
    {
        return $this->belongsToMany(Inn::class);
    }
}
