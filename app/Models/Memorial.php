<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memorial extends Model
{
    use HasFactory;
    public $table = 'memorials';
    protected $primaryKey = 'memorial_id';
    public $timestamps = false;

    public function userInfo()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

