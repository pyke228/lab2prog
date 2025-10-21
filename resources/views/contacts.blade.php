@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
    <h1>Контакты</h1>

    <ul class="list-group">
        @foreach($contacts as $key => $value)
            <li class="list-group-item">
                <strong>{{ $key }}:</strong> {{ $value }}
            </li>
        @endforeach
    </ul>
@endsection