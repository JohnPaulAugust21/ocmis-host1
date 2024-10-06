<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Niche extends Model
{
    use HasFactory;
    public $table = 'niches';
    protected $primaryKey = 'niche_id';
    public $timestamps = false;
    protected $fillable = [
        'status',
        'paymentmethod',
        'paymenttype',
        'ref',
        'downpayment',
        'monthly',
        'date',
        'user_id',
    ];
    public function urnInfo()
    {
        return $this->hasOne(Urn::class,'niche_id');
    }
    public function buildingInfo()
    {
        return $this->BelongsTo(Building::class,'building_id');
    }

    public function ownerInfo()
    {
        return $this->hasOne(OwnerNiche::class,'niche_id');
    }
}
