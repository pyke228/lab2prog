<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Новая статья</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #343a40; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f8f9fa; }
        .footer { text-align: center; padding: 20px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Новостной сайт</h1>
        </div>
        
        <div class="content">
            <h2>Опубликована новая статья!</h2>
            
            <h3>{{ $article->title }}</h3>
            <p><strong>Автор:</strong> {{ $article->user->name }}</p>
            <p><strong>Дата публикации:</strong> {{ $article->created_at->format('d.m.Y H:i') }}</p>
            
            <div style="margin: 20px 0; padding: 15px; background: white; border-left: 4px solid #007bff;">
                {{ Str::limit($article->content, 200) }}
            </div>
            
            <a href="{{ url('/articles/' . $article->id) }}" 
               style="display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;">
                Читать статью
            </a>
        </div>
        
        <div class="footer">
            <p>Это автоматическое уведомление. Пожалуйста, не отвечайте на это письмо.</p>
        </div>
    </div>
</body>
</html>