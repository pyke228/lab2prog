@extends('layouts.app')

@section('title', 'Создать статью')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Создать новую статью</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('articles.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Заголовок</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Содержание</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="6" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="preview_image" class="form-label">Превью изображение (URL)</label>
                        <input type="url" class="form-control" id="preview_image" name="preview_image" 
                               value="{{ old('preview_image') }}" placeholder="https://example.com/image.jpg">
                    </div>

                    <div class="mb-3">
                        <label for="full_image" class="form-label">Полное изображение (URL)</label>
                        <input type="url" class="form-control" id="full_image" name="full_image" 
                               value="{{ old('full_image') }}" placeholder="https://example.com/full-image.jpg">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Создать статью</button>
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection