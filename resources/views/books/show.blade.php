@extends('layout')
@section('content')

    <img src="{{$book->cover_image_url}}" style="float:left;margin-right:5%;height: 80vh"></img>
    <div class="card"style="padding:10px;">
        <p><h1 style="">{{$book->title}} <a href="{{url('books')}}/{{$book->id}}/edit"> <i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="#" data-toggle="modal" data-target="#exampleModal" style="color:red">  <i class="fa fa-trash" aria-hidden="true"></i></a></h1></p>
        <br>
        <p><b>ISBN: </b>{{$book->isbn}}</p>
        <p><b>Publisher: </b>{{$book->publisher}}</p>
        <p><b>Series: </b>@if($book->series != NULL){{$book->_series->name}}@endif</p>
        <p><b>Number of pages: </b>{{$book->number_of_pages}}</p>
        <p><b>Author: </b>{{$book->author}}</p>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete {{$book->title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete "{{$book->title}}"
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{url('/books')}}/{{$book->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
