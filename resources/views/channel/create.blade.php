@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create New Channel
                </div>
                <div class="panel-body">
                    <form action="{{route('channels.store')}}" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="input your channels...">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Make Channel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection