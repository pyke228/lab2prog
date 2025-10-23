<x-mail::message>
Для статьи
# "{{$article->title}}"
добавлен комментарий с текстом:
{{$comment->text}}

<x-mail::button :url="$url">
Просмотр статьи
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>