@extends('layout')

@section('content')
<article class="post container">

    @include( $post->viewType() )

    <div class="content-post">

        @include('posts.header')

        <h1>{{ $post->title }}</h1>

        <div class="divider"></div>

        <div class="image-w-text">
            {!! $post->body !!}

        </div>

        <footer class="container-flex space-between">
            @include('partials.social-links', ['description' => $post->title])

            @include('posts.tags')
        </footer>

        <div class="comments">
            <div class="divider"></div>
            <div id="disqus_thread"></div>
            @include('partials.disqus-script')
        </div><!-- .comments -->
    </div>
</article>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/adminlte/carouselBootstrap/css/bootstrap.css') }}">
@endsection

@section('scripts')
<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script src="{{ asset('/adminlte/carouselBootstrap/js/bootstrap.js') }}"></script>
@endsection

