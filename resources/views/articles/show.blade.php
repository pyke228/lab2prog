@extends('layouts.app')

@section('title', $article->title)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $article->title }}</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning">Редактировать</a>
                <form action="{{ route('articles.destroy', $article) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>

        <p class="text-muted">Автор: {{ $article->user->name }}</p>
        
        @if($article->preview_image)
            <img src="{{ $article->preview_image }}" class="img-fluid rounded mb-4" alt="{{ $article->title }}">
        @endif

        <div class="article-content">
            <p>{{ $article->content }}</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('articles.index') }}" class="btn btn-secondary">← Назад к списку</a>
        </div>
    </div>
</div>

<div class="mt-5">
    <h4>Комментарии ({{ $article->comments->where('moderated', true)->count() }})</h4>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @auth
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('comments.store', $article) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="content" class="form-label">Добавить комментарий</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" name="content" rows="3" required></textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
    @else
    <div class="alert alert-info">
        <a href="{{ route('login') }}">Войдите</a>, чтобы оставить комментарий.
    </div>
    @endauth

    @foreach($article->comments->where('moderated', true) as $comment)
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <strong>{{ $comment->user->name }}</strong>
                <small class="text-muted">{{ $comment->created_at->format('d.m.Y H:i') }}</small>
            </div>
            <p class="mb-0 mt-2">{{ $comment->content }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection