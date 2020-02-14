@extends('layout')

@section('content')

    <h1>Add a series</h1>
    <form method="POST" action="{{url('/series')}}">
        <div class="form-group">
            @csrf
            <div class="form-group">
                <label for="name">Name: </label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="" required>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL: </label>
                <input type="text" id="image_url" name="image_url" class="form-control" placeholder="Image URL" value="" required>
            </div>
        </div>
        <button class="btn btn-primary btn-lg btn-block">Add</button>
    </form>

    </div>

@endsection
