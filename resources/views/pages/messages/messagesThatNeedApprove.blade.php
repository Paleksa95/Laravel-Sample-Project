@extends('main.main')

@section('Title', 'Create thread')

@section('content')

    @include('parts.session')


    <center>
        <h1>Approve messages.</h1>


        @if($messages->count()== 0)
           <h1>'No messages at this moment'</h1>
        @endif

        @foreach($messages as $m)
            <div class="container">
                <div class="row">
                    <div class="col-md-12">


                        <form action="{{ route('approveMessage') }}" method="POST">
                            <div class="form-group">

                            </div>
                            <input type="hidden" name="message_id" value="{{ $m->id }}">
                            Message body: {{$m->body}}
                            <br>
                            Message by: {{$m->user->name}}
                            <br>
                            {{ csrf_field() }}
                            <input type="submit" value="Approve message" class="btn btn-lg btn-primary btn-bloc">


                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach


    </center>



@endsection