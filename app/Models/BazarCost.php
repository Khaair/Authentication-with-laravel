<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BazarCost extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cost', 'cost_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
