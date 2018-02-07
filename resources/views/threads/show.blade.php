@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{ $thread->title }}</h4>
                    by. <a href="#">{{ $thread->owner->name }}</a>
                </div>

                <div class="panel-body">
                    {{ $thread->body }}
                </div>
            </div>

            @foreach($replies as $reply)
                @include('threads.reply')
            @endforeach

            {{ $replies->links() }}

            @if(auth()->check())
                <form action="{{ $thread->path().'/reply' }}" method="POST">
                {{ csrf_field() }}
                    <div class="form-group">
                        <textarea name="body" class="form-control" placeholder="have something to say" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Post</button>
                    </div>
                </form>
            @else
                <p class="text-center">Please <a href="{{ route('login') }}">signin</a> to participate in this discussion</p>
            @endif
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>This thread was published at {{ $thread->created_at->diffForHumans() }}</p>
                    <p>by. {{ $thread->owner->name }}</p>
                    <p>{{ str_plural('Reply', $thread->replies()->count()) }} count {{ $thread->replies()->count() }}</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
