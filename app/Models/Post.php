<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    // de los datos que se envian en el formulario solo se guarda el valor del campo body en base de datos
    protected $fillable = [
        'body'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
