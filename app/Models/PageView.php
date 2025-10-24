<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = ['url', 'ip_address', 'user_agent'];

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeArticleViews($query)
    {
        return $query->where('url', 'like', '%/articles/%');
    }
}