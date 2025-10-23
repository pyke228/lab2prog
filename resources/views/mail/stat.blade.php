<x-mail::message>
# Статистика

Количество просмотров статей {{$article_count}}
Количество новых комментариев {{$comment_count}}
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>