<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'titulo', 'contenido'])]
class Publicacion extends Model
{
    // Relación inversa 1:N → una publicación pertenece a un usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
