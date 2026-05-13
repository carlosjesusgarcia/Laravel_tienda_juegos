<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function home()
    {
        // Traemos las últimas 4 entradas ordenadas por fecha de creación (de más nueva a más vieja)
        $posts = Post::latest()->take(4)->get();

        return view('welcome', [
            'posts' => $posts,
        ]);
    }

     public function about()
    {
        return view('about');
    }
}
