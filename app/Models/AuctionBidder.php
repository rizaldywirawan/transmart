<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class AuctionBidder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public $appends = ['formatted_bid_price'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::uuid4();
        });
    }

    public function getFormattedBidPriceAttribute()
    {
        return number_format($this->bid_price, 0, ',', '.');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
