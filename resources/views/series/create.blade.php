@extends('layout')

@section('content')

    <h1>Add a series</h1>
    <form method="POST" action="{{url('/series')}}">
        <div class="form-group">
            @csrf
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
            <input type="text" name="image_url" class="form-control" placeholder="Image URL" required>
        </div>
        <button class="btn btn-primary btn-lg btn-block">Add</button>
    </form>

    </div>

@endsection
