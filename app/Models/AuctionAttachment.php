<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuctionAttachment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'auction_id',
        'file_name',
        'file_path',
        'extension',
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
