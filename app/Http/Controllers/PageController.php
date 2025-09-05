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
            // consultar los posts asociados a un usuario a traves de la relacion posts definida en el modelo Usuario
            $posts = $request->user()->posts()->latest()->get();
        } else {
            // consulta de todos los posts ordenados del mas antiguo al mas reciente
            $posts = Post::latest()->get();
        }

        return view('dashboard', compact('posts'));
    }
}
