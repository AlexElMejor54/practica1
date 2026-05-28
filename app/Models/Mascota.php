<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'nombre', 'tipo', 'edad'])]
class Mascota extends Model
{
    // Relación inversa 1:1 → un usuario tiene una mascota
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
