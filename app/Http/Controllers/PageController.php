<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard(Request $request) {
        // dd($request->all());

        // si el parametro de la ruta for-me es true, se consultan los posts del usuario logueado
        if ($request->get('for-me')) {
            $user = $request->user(); // usuario autenticado en el sistema

            // ids de los usuarios asociados como amigos al usuario autenticado y el mismo id del usuario autenticado
            $users_ids = $user->friends()->pluck('id')->push($user->id);

            // se consultan todos los posts que se encuentren asociados a los ids anteriores
            $posts = Post::with('user')->whereIn('user_id', $users_ids)->latest()->get();
        } else {
            // consulta de todos los posts ordenados del mas antiguo al mas reciente
            $posts = Post::with('user')->latest()->get();
        }

        return view('dashboard', compact('posts'));
    }

    public function friendProfile(User $user) {
        $posts = $user->posts()->latest()->get();

        return view('friendProfile', compact('user', 'posts'));
    }

    public function status(Request $request) {
        $requests   = $request->user()->pendingFrom; // solicitudes de amistad recibidas
        $sent       = $request->user()->pendingTo; // solicitudes de amistad enviadas
        $friends    = $request->user()->friends(); // solicitudes de amistad aceptadas // friends() retorna una coleccion ya construida

        return view('status', compact('requests', 'sent', 'friends'));
    }
}
