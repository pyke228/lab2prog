<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // ДОБАВЬ ЭТУ СТРОКУ

class MainController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->latest()->paginate(3);
        return view('welcome', compact('articles'));
    }

    public function gallery($id)
    {
        // Используем БД вместо JSON
        $article = Article::findOrFail($id);
        return view('gallery', compact('article'));
    }
}