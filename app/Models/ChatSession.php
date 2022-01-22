<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ChatSession extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'event_id',
        'name',
        'started_at',
        'ended_at',
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
}
