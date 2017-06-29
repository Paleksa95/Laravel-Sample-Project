@if (session('verify'))

    <center>

        <div class="alert alert-success">
            {{ session('verify') }}
        </div>

    </center>
@endif

@if (session('invalidate'))

    <center>

        <div class="alert alert-danger">
            {{ session('invalidate') }}
        </div>

    </center>
@endif



@if ($errors->any())
    <center>
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </ul>
    </div>
    </center>
@endif