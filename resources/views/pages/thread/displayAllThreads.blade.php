@extends('main.main')

@section('Title', 'List')

@section('content')



    @foreach($threads as $t)
        <center>
           <h1>Click on link to see whole thread: <a href="{{ route('viewThread',$t->id) }}"> {{$t->title}}</a></h1>
            <br>
           <h3>Posted by:{{$t->user->name}}</h3>

            <hr style="border-bottom:5px solid black;">
        </center>
    @endforeach

    <center>
        {{ $threads->links() }}
    </center>



@endsection