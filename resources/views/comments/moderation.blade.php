@extends('layouts.app')

@section('title', 'Модерация комментариев')
@section('content')
<div class="container">
    <h1>Модерация комментариев</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($pendingComments->count() > 0)
        @foreach($pendingComments as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <h5 class="card-title">
                            К статье: <a href="{{ route('articles.show', $comment->article) }}">{{ $comment->article->title }}</a>
                        </h5>
                        <p class="card-text"><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                        <small class="text-muted">{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                    </div>
                    <div class="d-flex gap-2 ms-3">
                        <form action="{{ route('comments.moderate', [$comment, 'approve']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">✓ Одобрить</button>
                        </form>
                        <form action="{{ route('comments.moderate', [$comment, 'reject']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">✗ Отклонить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="alert alert-info">
            Нет комментариев для модерации.
        </div>
    @endif
</div>
@endsection