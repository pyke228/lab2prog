<?php

namespace App\Http\Middleware;

use App\Models\ArticleView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackArticleView
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Трекаем только успешные GET запросы к статьям
        if ($this->shouldTrack($request, $response)) {
            $articleId = $request->route('article');
            
            if ($articleId) {
                ArticleView::create([
                    'article_id' => $articleId,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            }
        }

        return $response;
    }

    protected function shouldTrack(Request $request, Response $response): bool
    {
        return $request->isMethod('GET') && 
               $response->getStatusCode() === 200 &&
               $request->routeIs('articles.show');
    }
}