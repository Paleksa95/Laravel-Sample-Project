@extends('main.main')

@section('Title', 'Edit Thread')

@section('content')

    @include('parts.session')




    <div class="container">
        <div class="row">
            <div class="col-md-12">


                @if($thread)
                    <h1>Edit Thread</h1>

                    <hr>
                    <form action="{{ route('editThread') }}" method="POST">
                        <div class="form-group">

                            <div class="form-group">

                                <label name="title">Title:</label>
                                <input id="title" name="title" class="form-control" placeholder="Enter title here.." value="{{$thread->title}}">


                                <label name="body">Message body:</label>
                        <textarea id="body" name="body" class="form-control"
                        >{{$thread->body}}</textarea>
                            </div>
                            <input type="hidden" name="id" value="{{ $thread->id }}">

                            {{ csrf_field() }}
                            <input type="submit" value="Update Thread" class="btn btn-lg btn-primary btn-bloc">
                        </div>
                    </form>
            </div>
        </div>
    </div>
    @else
        <center>
            <h1>No thread found</h1>
        </center>
    @endif

@endsection