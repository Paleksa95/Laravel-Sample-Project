@extends('main.main')

@section('Title', 'Edit Message')

@section('content')

    @include('parts.session')




    <div class="container">
        <div class="row">
            <div class="col-md-12">




                @if($message)
                <h1>Edit Message</h1>

                <hr>
                <form action="{{ route('editMessage') }}" method="POST">
                    <div class="form-group">

                        <div class="form-group">
                            <label name="body">Message body:</label>
                        <textarea id="body" name="body"  class="form-control"
                                 >{{$message->body}}</textarea>
                        </div>
                        <input type="hidden" name="id" value="{{ $message->id }}">

                        {{ csrf_field() }}
                        <input type="submit" value="Update Message" class="btn btn-lg btn-primary btn-bloc">
                    </div>
                </form>
            </div>
        </div>
    </div>
@else
    <center>
        <h1>No message found</h1>
    </center>
@endif

@endsection