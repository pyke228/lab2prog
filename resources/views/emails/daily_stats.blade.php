<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Статистика сайта</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .stats-container {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 10px 10px;
        }
        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin: 10px 0;
            background: white;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📊 Ежедневная статистика</h1>
        <p>Статистика использования сайта за {{ $date }}</p>
    </div>
    
    <div class="stats-container">
        <div class="stat-item">
            <span>👁️ Просмотров статей</span>
            <span class="stat-number">{{ $article_views }}</span>
        </div>
        
        <div class="stat-item">
            <span>💬 Новых комментариев</span>
            <span class="stat-number">{{ $new_comments }}</span>
        </div>
        
        <div class="stat-item">
            <span>👥 Модераторов уведомлено</span>
            <span class="stat-number">{{ $total_moderators }}</span>
        </div>
    </div>
    
    <div class="footer">
        <p>Автоматическая рассылка • Система статистики</p>
        <p>© {{ date('Y') }} Ваш сайт</p>
    </div>
</body>
</html>