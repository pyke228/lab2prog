<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->latest()->paginate(3);
        return view('welcome', compact('articles'));
    }
    
    public function gallery($id)
    {
        // Если используешь JSON файл
        $articles = json_decode(file_get_contents(public_path('articles.json')), true);
        $article = $articles[$id - 1] ?? null;
        
        if (!$article) {
            abort(404);
        }
        
        return view('gallery', compact('article'));
    }
}