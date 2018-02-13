@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>
                        {{$profileUser->name}}
                        <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h1>
                </div>
                @foreach($activities as $date => $activity)
                    <h4 class="page-header">
                        {{ $date }}
                    </h4>
                    @foreach($activity as $record)
                        @include("profiles.activity.{$record->type}", ['activity' => $record])
                    @endforeach
                @endforeach
                {{--  {{ $threads->links() }}  --}}
            </div>
        </div>

    </div>

@endsection
