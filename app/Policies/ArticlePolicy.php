<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Article $article)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->isModerator();
    }

    public function update(User $user, Article $article)
    {
        return $user->isModerator();
    }

    public function delete(User $user, Article $article)
    {
        return $user->isModerator();
    }
}