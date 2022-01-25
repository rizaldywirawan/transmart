<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class BusinessUnit extends Model
{
    use HasRelationships;
    use HasFactory;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $table = 'business_units';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::uuid4();
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function participants()
    {
        return $this->hasMany(Profile::class);
    }

    public function attendances()
    {
        return $this->hasManyDeep(
            'App\Models\Attendance',
            [
                'App\Models\Profile',
                'App\Models\User'
            ],
            [
                'business_unit_id',
                'id',
                'user_id'
            ],
            [
                'id',
                'user_id',
                'id'
            ]
        );
    }
}
