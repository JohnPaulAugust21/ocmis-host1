<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceList extends Model
{
    use HasFactory;
    protected $fillable = [
        'status'
    ];
    public $table = 'service_list';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function categoryInfo()
    {
        return $this->belongsTo(Services::class,'service_id');
    }
     public function getPriceAttribute()
    {
        return $this->categoryInfo->price ?? null;
    }
     public function userInfo()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function priestInfo()
    {
        return $this->belongsTo(Priest::class,'priest_id');
    }
    public function scheduleInfo()
    {
        return $this->belongsTo(PriestSchedule::class,'schedule_id');
    }
}
