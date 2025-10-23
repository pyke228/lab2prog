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
use Illuminate\Support\Facades\Cache;


class ArticleController extends Controller
{
    public function index()
    {
        $page = request('page', 1);
        $articles = Cache::remember('articles_page_' . $page, 3600, function () {
            return Article::with('user')->latest()->paginate(10);
        });

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

        event(new NewArticleEvent($article));
        VeryLongJob::dispatch($article);

        $readers = \App\Models\User::where('role_id', 2)->get();
        Notification::send($readers, new NewArticleNotification($article));

        Cache::forget('articles_page_1');
        Cache::forget('articles_page_2');
        Cache::forget('articles_page_3');

        return redirect()->route('articles.index')
            ->with('success', 'Статья создана! Кэш обновлен!');
    }

    public function show(Article $article)
    {
        $article = Cache::rememberForever('article_' . $article->id, function () use ($article) {
            return $article->load(['comments.user', 'user']);
        });

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

        Cache::forget('article_' . $article->id);
        Cache::forget('articles_page_1');
        Cache::forget('articles_page_2');

        return redirect()->route('articles.index')
            ->with('success', 'Статья обновлена! Кэш очищен!');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        // ПОЛНОСТЬЮ ОЧИЩАЕМ КЭШ
        Cache::flush();

        return redirect()->route('articles.index')
            ->with('success', 'Статья удалена! Кэш очищен!');
    }

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
}