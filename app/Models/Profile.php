<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'company',
        'job_title',
        'phone',
        'email',
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

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::uuid4();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
