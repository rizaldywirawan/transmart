<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'user_id',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::uuid4();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
