<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Mail\NewArticleMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Jobs\VeryLongJob;
use App\Events\NewArticleEvent;
use App\Notifications\NewArticleNotification;
use Illuminate\Support\Facades\Notification;


class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'preview_image' => 'nullable|url',
            'full_image' => 'nullable|url'
        ]);

        $article = Article::create([
            ...$validated,
            'user_id' => Auth::id()
        ]);

        \Log::info('=== START NOTIFICATION PROCESS ===');
        \Log::info('Article created: ' . $article->title);

        // Проверяем читателей
        $readers = \App\Models\User::where('role_id', 2)->get();
        \Log::info('Readers found: ' . $readers->count());
        \Log::info('Reader emails: ' . $readers->pluck('email')->implode(', '));

        // Отправляем уведомления
        foreach ($readers as $reader) {
            \Log::info('Sending to: ' . $reader->email);
            try {
                $reader->notify(new \App\Notifications\NewArticleNotification($article));
                \Log::info('✓ Notification sent to: ' . $reader->email);
            } catch (\Exception $e) {
                \Log::error('✗ Error sending to ' . $reader->email . ': ' . $e->getMessage());
            }
        }

        \Log::info('=== END NOTIFICATION PROCESS ===');

        return redirect()->route('articles.index')
            ->with('success', 'Статья создана! Уведомления отправлены!');
    }

    public function show(Article $article)
    {
        $article->load(['comments.user', 'user']);
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $article->update($validated);
        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
}