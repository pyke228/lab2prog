@extends('layouts.app')

@section('title', 'Главная')
@section('content')
<div class="row">
    <div class="col-12">
        <h1>Последние новости</h1>
        
        @if(isset($articles) && count($articles) > 0)
            @foreach($articles as $index => $article)
            <div class="card mb-4">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="{{ route('gallery', $index + 1) }}">
                            <img src="/images/{{ $article['preview_image'] }}" class="img-fluid rounded-start" style="height: 200px; object-fit: cover;" alt="{{ $article['name'] }}">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article['name'] }}</h5>
                            <p class="card-text">
                                <small class="text-muted">{{ $article['date'] }}</small>
                            </p>
                            <p class="card-text">
                                {{ $article['shortDesc'] ?? substr($article['desc'], 0, 150) }}...
                            </p>
                            <a href="{{ route('gallery', $index + 1) }}" class="btn btn-primary">Читать далее</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <p>Статей пока нет...</p>
        @endif

        @if($articles->count() > 0)
            @foreach($articles as $article)
            <!-- существующий код статей -->
            @endforeach

            <!-- Пагинация -->
            <div class="d-flex justify-content-center mt-4">
                {{ $articles->links() }}
            </div>
        @else
            <p>Статей пока нет...</p>
        @endif
    </div>
</div>
@endsection