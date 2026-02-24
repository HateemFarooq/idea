<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Idea;

class Step extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'idea_id',
        'description',
        'completed',
    ];

    protected $attributes = [
        'completed' => false,
    ];

    /**
     * The idea this step belongs to
     */
    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }
}