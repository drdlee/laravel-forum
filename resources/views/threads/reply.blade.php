<div class="panel panel-default">
    <div class="panel-heading">
        <div class="level">
            <span class="flex">
                <a href="{{ route('profile', $reply->owner) }}">{{ $reply->owner->name }}</a>
                said.
                {{ $reply->created_at->diffForHumans() }}
            </span>
            <div>
                <form action="/replies/{{$reply->id}}/favorite" method="POST">
                {{csrf_field()}}
                    <button type="submit" class="btn btn-default btn-sm" {{ $reply->isFavorited() ? 'disabled' : '' }} >
                        {{ $reply->favorites_count }} {{ str_plural('favorite', $reply->favorites_count) }}
                        {{--  $reply_favorite_count is getting its data from getFavoritesCountAttribute in Reply method/model --}}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="panel-body">
        {{ $reply->body }}
    </div>
</div>
