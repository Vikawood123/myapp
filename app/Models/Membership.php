<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'trainings_count',
        'validity_days',
        'is_active'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
