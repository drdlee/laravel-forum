@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Forum Threads</div>

                <div class="panel-body">
                <a href="/threads/create" class="btn btn-primary">Create New Thread</a>
                <a href="/channels/create" class="btn btn-primary">create channel</a>
                    @foreach($threads as $thread)
                        <article>
                            <div class="level">
                                <h4 class="flex"><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h4>
                                <a href="{{ $thread->path() }}">{{ $thread->replies()->count() }} {{ str_plural('Reply', $thread->replies()->count()) }}</a>
                            </div>
                            <div>{{ $thread->body }}</div>
                        </article>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
