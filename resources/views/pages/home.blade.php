@extends('layout')

@section('content')
<section class="posts">
    <div class="image-home" >
        <img src="{{asset('/img/image-home.jpg') }}" alt="" srcset="">
    </div>

<div class="container">
    @if (isset($title))
        <h3>{{ $title }}</h3>
    @endif
    @forelse($posts as $post)
        <article class="post">

            @include( $post->viewType('home') )


            <div class="content-post">

                @include('posts.header')

                <h1>{{ $post->title }}</h1>

                <div class="divider"></div>

                <p>{{ $post->excerpt }}</p>

                <footer class="container-flex space-between">

                    <div class="read-more">
                        <a href="{{ route('posts.show', $post) }}" class="text-uppercase c-green">Leer más</a>
                    </div>

                    @include('posts.tags')

                </footer>
            </div>
        </article>
    @empty
        <article class="post">
            <div class="content-post">

                <h1>No hay publicaciones todavía.</h1>

            </div>
        </article>
    @endforelse
</div>
</section><!-- fin del section.posts -->

{{ $posts->appends(request()->all())->links() }}

@stop
