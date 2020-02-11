@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($books as $book)
            <div class="col-lg-3 col-md-6 mb-4" style="">
                <a href="{{url('books')}}/{{ $book->id }}">
                    <div class="card h-100">
                        <img class="card-img-top" src="{{ $book->cover_image_url }}" alt="cover" >
                        <div class="card-body" style="">
                            <h6 class="card-title">
                                <a href="#">{{ $book->title }}</a>
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
