<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'meal_count', 'meal_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
