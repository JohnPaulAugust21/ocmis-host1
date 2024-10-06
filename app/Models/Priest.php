<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priest extends Model
{
    use HasFactory;
    public $table = 'priests';
    protected $primaryKey = 'priest_id';
    public $timestamps = false;
}
