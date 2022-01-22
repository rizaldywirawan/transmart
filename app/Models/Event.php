<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'event_category_id',
        'event_format_id',
        'name',
        'geopoint',
        'geopoint_address',
        'online_url',
        'started_at',
        'ended_at',
        'logo_path',
        'landing_page_url',
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

    public function eventUsers()
    {
        return $this->hasMany(EventUser::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }

    public function ticketExchange()
    {
        return $this->hasMany(TicketExchange::class);
    }

    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function eventFormat()
    {
        return $this->belongsTo(EventFormat::class);
    }
}
