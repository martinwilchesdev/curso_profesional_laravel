<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function store(Request $request, User $user) {
        // solicitudes de amistad realizadas por el usuario autenticado
        $from_to = $request->user()->from()->where('to_id', $user->id)->exists();
        // solicitudes de amistda realizadas al usuario autenticaddo
        $to_from = $request->user()->from()->where('from_id', $user->id)->exists();

        // se restringe que mas de una solicitud de amistad entre 2 usuarios
        if ($from_to || $to_from) return back();

        // se restringe que un usuario no pueda solicitarse amistad a si mismo
        if ($request->user()->id === $user->id) return back();

        // se utiliza la relacion from para crear un nuevo registro en la tabla friends con los datos del usuario al que se le quiere realizar la solicitud de amistad
        $request->user()->from()->attach($user);

        return back();
    }
}
