@extends('layout')
@section('navbar_item')
    <li class="nav-item">
        <a  style="color:green; " class="nav-link"href="{{url('/series/create')}}"><b>Add <i class="fas fa-plus"></i></b></a>
    </li>
@endsection
@section('content')
    <div class="container">

        <div class="row">
            @if(count($series) == 0)
                No series found.
            @endif
            @foreach ($series as $serie)
                <div class="col-lg-3 col-md-6 mb-4" style="">
                    <a href="{{url('/series')}}/{{ $serie->id }}" style="text-decoration: none;">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{ $serie->image_url }}" alt="image" >
                            <div class="card-body" style="color: black;">
                                <h6 class="card-title">
                                    <b>
                                        {{ $serie->name }}
                                    </b>
                                </h6>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>



    </div>

    {{ $series->links() }}
@endsection
