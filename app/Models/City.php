<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\State;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'state_id',
    ];

    public function state(): BelongsTo
{
    return $this->belongsTo(State::class);
}
}
