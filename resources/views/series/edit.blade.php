@extends('layout')

@section('content')

    <h1>Edit series '{{$series->name}}'</h1>
    <form method="POST" action="{{url('/series')}}/{{$series->id}}">
        <div class="form-group">
            @csrf
            @method('put')
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{$series->name}}" required>
            <input type="text" name="image_url" class="form-control" placeholder="Image URL" value="{{$series->image_url}}" required>
        </div>
        <button class="btn btn-primary btn-lg btn-block">Save</button>
    </form>

    </div>

@endsection
