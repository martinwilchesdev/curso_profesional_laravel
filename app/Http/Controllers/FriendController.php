<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function store(Request $request, User $user) {
        // si no existe una relacion entre los usuarios o si no es el mismo usuario autenticado quien trata de solicitarse amistad, se realiza la accion de guardado
        if (!$request->user()->isRelated($user)) {
            // se utiliza la relacion from para crear un nuevo registro en la tabla friends con los datos del usuario al que se le quiere realizar la solicitud de amistad
            $request->user()->from()->attach($user);
        }

        return back();
    }

    public function update(Request $request, User $user) {
        // a traves de la relacion to, actualizar el valor del campo accepted de la solicitud de amistad recibida
        $request->user()->to()->where('from_id', $user->id)->update([
            'accepted' => true
        ]);

        return back();
    }
}
