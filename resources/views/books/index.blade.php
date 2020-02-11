@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            @if(count($books) == 0)
                No books found.
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

    {{ $books->links() }}
@endsection
