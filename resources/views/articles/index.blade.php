@extends('layouts.app')

@section('title', 'Все статьи')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Все статьи</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary">Создать статью</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($articles->count() > 0)
    @foreach($articles as $article)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
            <p class="card-text">{{ Str::limit($article->content, 150) }}</p>
            <div class="d-flex gap-2">
                <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-info">Просмотр</a>
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-warning">Редактировать</a>
                <form action="{{ route('articles.destroy', $article) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
@else
    <p>Статей пока нет.</p>
@endif
@endsection