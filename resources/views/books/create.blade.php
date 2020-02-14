@extends('layout')

@section('content')
    <div class="container" style="display: flex;justify-content: space-between;flex-direction: column;position: absolute;left: 50%;transform: translateX(-50%);bottom: 0; top: 80px;">
    <form method="POST" onsubmit="return FindBook();" id="ajax-form-submit">
        @csrf

        <div class="form-group">
            <label class="" for="series">Series</label>
            <select name="series" class="custom-select" id="series">
                @foreach($series as $serie)
                        <option value="{{$serie->id}}">{{$serie->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="" for="isbn">ISBN: </label>
            <input type="number" name="isbn" class="form-control" id="isbn" placeholder="ISBN">
        </div>
        <button class="btn btn-primary btn-lg btn-block">Add</button>
    </form>
    <div style="margin: auto"><i class="fa fa-spinner fa-spin waiting" style="font-size:150px; display:none"></i></div>
    <div class="alert alert-success" id="alert" role="alert" style="display: none;">

    </div>
    <script>
        function FindBook() {
            var isbn = $("#isbn").val();
            var series = $("#series").val();
            $('.waiting').show();
            //Run Ajax
            $.ajax({
                type:"POST",
                url:"{{url('books')}}/",
                dataType: "json",
                data: {
                    "isbn": isbn,
                    "series": series,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(msg) {
                    $("#isbn").val("");
                    $('.waiting').hide();
                    $('#alert').text("'"+msg.title + "' successful added");
                    $('#alert').attr("style", "");
                    setTimeout(
                        function()
                        {
                            $('#alert').attr("style", "display: none;");
                        }, 1000);
                }
            });
            // To Stop the loading of page after a button is clicked
            return false;
        }

    </script>
    </div>
@endsection
