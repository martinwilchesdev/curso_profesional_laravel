<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard() {
        // consulta de todos los posts ordenados del mas antiguo al mas reciente
        $posts = Post::latest()->get();

        return view('dashboard', compact('posts'));
    }
}
