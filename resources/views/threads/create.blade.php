@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create New Thread
                </div>
                <div class="panel-body">
                    <form action="/threads" method="POST">
                    {{ csrf_field() }}
                        <select class="form-control" name="channel_id">
                            <option value="">Choose a channel</option>
                            @foreach ($channels as $channel)
                            <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : ''}}>{{ $channel->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="input your title here..." value="{{old('title')}}">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" rows="5" placeholder="write some thing here..." class="form-control">{{old('body')}}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Make Thread</button>
                        </div>

                        @if(count($errors))
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection