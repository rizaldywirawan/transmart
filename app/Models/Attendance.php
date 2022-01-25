<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Attendance extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'event_id',
        'user_id',
        'location_type_id',
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

    public $appends = ['formatted_created_at'];

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->isoFormat('ddd, DD MMMM YYYY HH:mm');
    }

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function locationType()
    {
        return $this->belongsTo(LocationType::class);
    }
}
