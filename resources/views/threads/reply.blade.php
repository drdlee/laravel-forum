<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <span class="flex">
                <a href="#">{{ $reply->owner->name }}</a>
                said.
                {{ $reply->created_at->diffForHumans() }}
            </span>
            <div>
                <form action="/replies/{{$reply->id}}/favorite" method="POST">
                {{csrf_field()}}
                    <button type="submit" class="btn btn-default btn-sm" {{ $reply->isFavorited() ? 'disabled' : '' }} >
                        {{ $reply->favorites()->count() }} {{ str_plural('favorite', $reply->favorites()->count()) }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="panel-body">
        {{ $reply->body }}
    </div>
</div>
