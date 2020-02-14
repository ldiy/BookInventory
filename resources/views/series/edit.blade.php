@extends('layout')

@section('content')

    <h1>Edit series '{{$series->name}}'</h1>
    <form method="POST" action="{{url('/series')}}/{{$series->id}}">
        <div class="form-group">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Name: </label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{$series->name}}" required>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL: </label>
                <input type="text" id="image_url" name="image_url" class="form-control" placeholder="Image URL" value="{{$series->image_url}}" required>
            </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block">Save</button>
    </form>

    </div>

@endsection
