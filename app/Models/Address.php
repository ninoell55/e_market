<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'label',
        'recipient_name',
        'recipient_phone',
        'province',
        'city',
        'address',
        'is_default',
    ];

    protected static function booted()
    {
        static::saving(function ($address) {
            if ($address->is_default) {
                static::where('user_id', $address->user_id)
                    ->where('id', '!=', $address->id)
                    ->update(['is_default' => false]);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'label';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
