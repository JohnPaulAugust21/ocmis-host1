<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerNiche extends Model
{
    use HasFactory;
    protected $fillable = [
        'niche_id',
        'owner_photo',
        'biography',
        'firstname',
        'lastname',
        'death_date',
        'birth_date'
    ];
}
