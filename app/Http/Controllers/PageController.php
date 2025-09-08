<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard(Request $request) {
        // dd($request->all());

        // si el parametro de la ruta for-me es true, se consultan los posts del usuario logueado
        if ($request->get('for-me')) {
            $user = $request->user(); // usuario autenticado en el sistema

            // amigos a los que les he enviado solicitud de amistad y han aceptado
            $from_ids = $user->friendsFrom()->pluck('users.id');
            // amigos que le han enviado solcitud de amistad al usuario autenticado y han sido aceptadas
            $to_ids = $user->friendsTo()->pluck('users.id');

            // combinacion de los ids de los usuarios anteriores
            $users_ids = $from_ids->merge($to_ids)->push($user->id);

            // se consultan todos los posts que se encuentren asociados a los ids anteriores
            $posts = Post::whereIn('user_id', $users_ids)->latest()->get();
        } else {
            // consulta de todos los posts ordenados del mas antiguo al mas reciente
            $posts = Post::latest()->get();
        }

        return view('dashboard', compact('posts'));
    }
}
