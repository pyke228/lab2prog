@extends('layouts.app')

@section('title', $article['name'])
@section('content')
<div class="row">
    <div class="col-12">
        <h1>{{ $article['name'] }}</h1>
        <p class="text-muted">{{ $article['date'] }}</p>
        
        <img src="/images/{{ $article['full_image'] }}" class="img-fluid rounded mb-4" alt="{{ $article['name'] }}">
        
        <div class="article-content">
            <p>{{ $article['desc'] }}</p>
        </div>
        
        <a href="/" class="btn btn-secondary">← Назад к статьям</a>
    </div>
</div>
@endsection