@extends('main.main')

@section('Title', 'One thread')

@section('content')
    @include('parts.session')


    <center>
        Thread posted by: <h3>{{$thread->user->name}}</h3>
        <hr>
        Thread title: <h1>{{$thread->title}}</h1>
        <br>
        Thread body: <h2>{{$thread->body}}</h2>

        @can('update', $thread)
        <li><a href={{ url('thread/edit', $thread->id) }}>Edit thread</a></li>
        @endcan


    </center>

    <hr style="border-bottom:5px solid black;">
    <center>
        <h1>Thread Messages:</h1>
    </center>
    <hr style="border-bottom:5px solid black;">

    @if($messages->count()==0)
        <center><h1> 'No messages'</h1></center>
    @else
        @foreach($messages as $m)

            <div align="left">
                User: {{$m->user->name}}
                <br>
                Users e-mail: {{$m->user->email}}
            </div>

            <div align="center">
                @if($m->approved == 1)
                    Comment:  <h3> {{$m->body}}</h3>

                    @can('update', $m)
                    <li><a href={{ url('message/edit', $m->id) }}>Edit message</a></li>
                    @endcan
                @else
                    <div style="color: red"> You can't see this post because it needs to be approved by moderator.</div>
                @endif
            </div>
            <hr>
        @endforeach
    @endif


    {{-- Form to submit new posts --}}




    <hr>

    @if(Auth::user())
    <center>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>Post new message to this thread</h1>

                <hr>
                <form action="{{ route('submitMessage') }}" method="POST">
                    <div class="form-group">

                    </div>
                    <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                    <div class="form-group">
                        <label name="body">Message:</label>
                        <textarea id="body" name="body" class="form-control"
                                  placeholder="Enter your message here.."></textarea>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" value="Post Message" class="btn btn-lg btn-primary btn-bloc">
                </form>
            </div>
        </div>

        </center>

    @endif






    <center>
        {{ $messages->links() }}
    </center>



@endsection