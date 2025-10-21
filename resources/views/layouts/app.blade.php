<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Мой сайт на Laravel')</title>
    <!-- Подключаем Bootstrap для быстрого красивого оформления -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">Мой Сайт</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <!-- Используем именованный маршрут -->
                            <a class="nav-link" href="{{ route('home') }}">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">О нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contacts') }}">Контакты</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Основная часть -->
    <main class="container my-4">
        <!-- Сюда будет подставляться содержимое конкретной страницы -->
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light text-center py-3 mt-5">
        <div class="container">
            <!-- Замените на свои данные -->
            Носов Данила, 231-131
        </div>
    </footer>

    <!-- Подключаем JS для Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>