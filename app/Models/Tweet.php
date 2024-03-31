<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use App\Models\Like;

class Tweet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'text',
        'created_by',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y h:i:s',
        'updated_at' => 'datetime:d/m/Y h:i:s',
        'deleted_at' => 'datetime:d/m/Y h:i:s',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,  'created_by', 'id');
    }

    public function like(): HasOne
    {
        return $this->hasOne(Like::class);
    }

}
