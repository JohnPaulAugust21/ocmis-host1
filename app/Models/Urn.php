<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urn extends Model
{
    use HasFactory;
    public $table = 'urns';
    protected $primaryKey = 'urn_id';
    public $timestamps = false;
}
