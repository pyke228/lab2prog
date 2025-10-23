<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'moderated', 'user_id', 'article_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function scopeModerated($query)
    {
        return $query->where('moderated', true);
    }

    public function scopePending($query)
    {
        return $query->where('moderated', false);
    }
}