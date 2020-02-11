@extends('layout')
@section('content')
    <form action="{{url('books')}}/{{$book->id}}" method="post">
        @method('put')
        @csrf
        <img src="{{$book->cover_image_url}}" style="float:left;margin-right:5%;height: 80vh"></img>
        <div class="card"style="padding:10px;">
            <div class="input-group input-group-lg mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Title</span>
                </div>
                <input name="title" id="title" type="text" value="{{$book->title}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Cover image</span>
                </div>
                <input type="text" name="cover_image_url" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{$book->cover_image_url}}" required>
            </div>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">ISBN</span>
                </div>
                <input name="isbn" type="text" value="{{$book->isbn}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Publisher</span>
                </div>
                <input name="publisher" type="text" value="{{$book->publisher}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="seris">Series</label>
                </div>
                <select name="series" class="custom-select" id="series">
                    <option selected>{{$book->series}}</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Number of pages</span>
                </div>
                <input name="number_of_pages" type="number" value="{{$book->number_of_pages}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Author</span>
                </div>
                <input name="author" type="text"  value="{{$book->author}}" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
            <button type="submit" id="save" name="save" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection
