@extends('layout')

@section('content')
    <div class="container">
        <h1>{{$series->name}} <a href="{{url('/series') . '/' . $series->id . '/edit'}}" ><i class="fas fa-edit"></i></a> <a href="#" data-toggle="modal" data-target="#exampleModal"><i style="color:red;" class="fas fa-trash-alt"></i></a></h1>
        <div class="row">
            @if(count($books) == 0)
                No books in this series.
            @endif
            @foreach ($books as $book)
                <div class="col-lg-3 col-md-6 mb-4" style="">
                    <a href="{{url('books')}}/{{ $book->id }}" style="text-decoration: none;">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{ $book->cover_image_url }}" alt="cover" >
                            <div class="card-body" style="color: black;">
                                <h6 class="card-title">
                                    <b>
                                        {{ $book->title }}
                                    </b>
                                </h6>
                                <h7>{{ $book->number_of_pages }} pages</h7>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete {{$series->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete "{{$series->name}}"
                    <br>
                    <b>All books in this series will also be removed!</b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{url('/series')}}/{{$series->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
