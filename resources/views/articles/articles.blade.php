<x-app-layout>
    <h1>Latest News</h1>

    @foreach ($articles as $article)
        <article>
            <h2>{{ $article->title }}</h2>
            <p>{{ Str::limit($article->content, 200) }}</p>
        </article>
    @endforeach
</x-app-layout>
