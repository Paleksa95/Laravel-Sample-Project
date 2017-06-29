@extends('main.main')

@section('Title', 'Create thread')

@section('content')

    @include('parts.session')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>Create thread</h1>

                <hr>
                <form action="{{ route('submitThread') }}" method="POST">
                    <div class="form-group">
                        <label name="title">Title:</label>
                        <input id="email" name="title" class="form-control" placeholder="Enter title here..">
                    </div>

                    <div class="form-group">
                        <label name="body">Message:</label>
                        <textarea id="body" name="body" class="form-control"
                                  placeholder="Enter your message here.."></textarea>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" value="Post thread" class="btn btn-lg btn-primary btn-bloc">
                </form>
            </div>
        </div>

@endsection