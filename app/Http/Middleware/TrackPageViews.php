<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;

class TrackPageViews
{
    public function handle(Request $request, Closure $next)
    {
        // Сначала выполняем запрос
        $response = $next($request);

        // Сохраняем просмотр страницы только после успешного выполнения
        if ($this->shouldTrack($request) && $response->getStatusCode() === 200) {
            try {
                PageView::create([
                    'url' => $request->getRequestUri(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            } catch (\Exception $e) {
                // Логируем ошибку, но не прерываем выполнение
                \Log::error('PageView tracking error: ' . $e->getMessage());
            }
        }

        return $response;
    }

    protected function shouldTrack(Request $request)
    {
        // Трекаем только GET запросы для статей
        return $request->isMethod('GET') && 
               ($request->is('articles/*') || $request->is('/'));
    }
}