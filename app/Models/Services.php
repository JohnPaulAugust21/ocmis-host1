<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    public $table = 'service_categories';
    protected $primaryKey = 'service_id';
    public $timestamps = false;

    public function serviceList()
    {
        return $this->belongsTo(ServiceList::class,'service_id','service_id');
    }
}
