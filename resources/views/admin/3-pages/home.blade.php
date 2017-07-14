@extends('admin.1-layout.layout')

@section('side-bar')
    <aside class="col-lg-2">
        <div class="list-group">
            @can('view', App\Models\Article::class)
            <a href="{{ route('admin.article.list') }}" class="list-group-item {{ $menuActive['article'] or '' }}">Articles</a>
            @endcan

            @can('view', App\Models\Comment::class)
            <a href="{{ route('admin.comment.list') }}" class="list-group-item {{ $menuActive['comment'] or '' }}">Comments
                @isset($badgeComment)
                    <span class="badge pull-right">{{ $badgeComment }}</span>
                @endisset
            </a>
            @endcan

            <a href="{{ route('admin.tag.list') }}" class="list-group-item {{ $menuActive['tag'] or '' }}">Tags</a>
            <a href="#" class="list-group-item {{ $menuActive['user'] or '' }}">Users</a>
            {{--TODO hide menu items if user doesn't have permission to the concrete section--}}

            @if (isset($msg) && !empty($msg))
                <div class="alert alert-info article_msg">{{ $msg }}</div>
            @endif
            @if ($errors->all())
                <div class="alert alert-danger article_msg">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
        </div>
    </aside>
@endsection

@section('content')
    <section class="col-lg-10">
        <div class="jumbotron">
            <h1>Welcome to admin world!</h1>
            <p>This all is yours</p>
        </div>
    </section>
@endsection