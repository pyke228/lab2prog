<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Новостной сайт</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app"></div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Новостной сайт</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index') }}">Статьи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">О нас</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contacts">Контакты</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    @auth
                        @if(Auth::user()->isModerator())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('articles.create') }}">Создать статью</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('comments.moderation') }}">Модерация</a>
                            </li>
                        @endif
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                Уведомления
                                @if(Auth::user()->unreadNotifications->count() > 0)
                                    <span class="badge bg-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(Auth::user()->unreadNotifications->count() > 0)
                                    <li><h6 class="dropdown-header">Новые уведомления</h6></li>
                                    @foreach(Auth::user()->unreadNotifications->take(5) as $notification)
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" 
                                        href="{{ $notification->data['url'] ?? '#' }}" 
                                        onclick="markAsRead('{{ $notification->id }}')">
                                            <div class="flex-grow-1">
                                                <small class="d-block">{{ $notification->data['message'] ?? 'Новое уведомление' }}</small>
                                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                            <span class="badge bg-primary ms-2">New</span>
                                        </a>
                                    </li>
                                    @endforeach
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-center" href="#">
                                            <small>Показать все уведомления</small>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                @else
                                    <li><a class="dropdown-item text-muted" href="#">Нет новых уведомлений</a></li>
                                @endif
                            </ul>
                        </li>

                        <!-- Профиль пользователя -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <small>Роль: {{ Auth::user()->role->name ?? 'Читатель' }}</small>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Выйти</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signin') }}">Регистрация</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <script>
    function markAsRead(notificationId) {
        fetch('/notifications/' + notificationId + '/read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });
    }
    </script>

    <main class="container my-4">
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p>Носов Данила, 231-131</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>