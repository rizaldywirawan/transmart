<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Auction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'event_id',
        'name',
        'description',
        'started_at',
        'start_price',
        'bid_increment',
        'won_by',
        'highest_price',
        'created_by',
        'deleted_by',
        'updated_by',
        'created_at',
        'deleted_at',
        'updated_at'
    ];

    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public $appends = ['formatted_started_at', 'formatted_start_price', 'formatted_bid_increment', 'bidding_status'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::uuid4();
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function auctionAttachments()
    {
        return $this->hasMany(AuctionAttachment::class);
    }

    public function auctionBidders()
    {
        return $this->hasMany(AuctionBidder::class)->orderBy('bid_price', 'DESC');
    }

    public function latestAuctionBidder()
    {
        return $this->hasOne(AuctionBidder::class)->orderBy('bid_price', 'DESC');
    }

    public function auctionBidderLatest()
    {
        return $this->hasOne(AuctionBidder::class)->latest();
    }

    public function auctionBidWinner()
    {
        return $this->belongsTo(User::class, 'won_by', 'id');
    }

    public function getFormattedStartedAtAttribute()
    {
        return Carbon::parse($this->started_at)->isoFormat('ddd, D MMMM YYYY HH:mm');
    }

    public function getFormattedStartPriceAttribute()
    {
        return number_format($this->start_price, 0, ',', '.');
    }

    public function getFormattedBidIncrementAttribute()
    {
        return number_format($this->bid_increment, 0, ',', '.');
    }

    public function getBiddingStatusAttribute()
    {
        $biddingTime = Carbon::parse($this->started_at)->addSeconds($this->live_time);

        $biddingStatus = "live";

        if (now()->greaterThan($this->started_at) && now()->lessThan($biddingTime)) {
            $biddingStatus = "live";
            $remainingTime = now()->diff(Carbon::parse($this->started_at)->addSeconds($this->live_time));
            $remainingTimeInSeconds = now()->diffInSeconds(Carbon::parse($this->started_at)->addSeconds($this->live_time));

        } else if(now()->greaterThan($this->started_at) && now()->greaterThan($biddingTime)) {
            $biddingStatus = "over";
            $remainingTimeInSeconds = 0;
            $remainingTime = 0;
        } else {
            $biddingStatus = "upcoming";
            $remainingTime = now()->diff($this->started_at);
            $remainingTimeInSeconds = now()->diffInSeconds($this->started_at);
        }

        return [
            'status' => $biddingStatus,
            'remaining-time' => $remainingTime,
            'remaining-time-in-seconds' => $remainingTimeInSeconds
        ];
    }
}
