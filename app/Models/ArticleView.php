<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleView extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'ip_address', 'user_agent'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }
}