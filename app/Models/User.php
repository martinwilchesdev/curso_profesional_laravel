<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // relacion uno a muchos // un usuario puede tener muchas publicaciones
    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function isRelated(User $user) {
        if (auth()->user()->id === $user->id) return true; // si el usuario autenticado ingresa a su mismo perfil, no se mostrar el boton de solicitar amistad

        /**
         * si el usuario autenticado le ha realizado una solicitud de amistad a otro usuario
         * si otro usuario le ha realizado una solicitud de amistad al usuario autenticado
        */
        return $this->from()->where('to_id', $user->id)->exists() || $this->to()->where('from_id', $user->id)->exists();
    }

    // solicitud de amistad realizada por mi usuario
    public function from() {
        return $this->belongsToMany(User::class, 'friends', 'from_id', 'to_id');
    }

    // solicitud de amistan recibida por mi usuario
    public function to() {
        return $this->belongsToMany(User::class, 'friends', 'to_id', 'from_id');
    }

    // relacion entre amigos
    public function friends() {
        // se obtiene una coleccion que contenga todos los amigos con los cuales el usuario ha establecido una amistad
        return $this->friendsFrom->merge($this->friendsTo);
    }

    // solicitud de amistad realizada por mi usuario y aceptada por el otro usuario
    public function friendsFrom() {
        return $this->from()->wherePivot('accepted', true);
    }

    // solicitud de amistad recibida por mi usuario y aceptada
    public function friendsTo() {
        return $this->to()->wherePivot('accepted', true);
    }

    // solicitudes de amistad realizadas pendientes por aceptar
    public function pendingFrom() {
        return $this->from()->wherePivot('accepted', false);
    }

    // solicitudes de amistad recibidas pendientes por aceptar
    public function pendingTo() {
        return $this->to()->wherePivot('accepted', false);
    }
}
