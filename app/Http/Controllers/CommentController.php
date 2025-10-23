<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'content' => 'required|min:3|max:1000'
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'article_id' => $article->id,
            'moderated' => false
        ]);

        return back()->with('success', 'Комментарий отправлен на модерацию!');
    }

    public function moderation()
    {
        $pendingComments = Comment::with(['user', 'article'])->pending()->latest()->get();
        return view('comments.moderation', compact('pendingComments'));
    }

    public function moderate(Comment $comment, $action)
    {
        if ($action === 'approve') {
            $comment->update(['moderated' => true]);
            return back()->with('success', 'Комментарий одобрен!');
        } elseif ($action === 'reject') {
            $comment->delete();
            return back()->with('success', 'Комментарий отклонен!');
        }

        return back()->with('error', 'Неизвестное действие!');
    }
}