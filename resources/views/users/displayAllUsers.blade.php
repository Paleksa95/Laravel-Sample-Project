@extends('main.main')

@section('Title', 'List of all users')

@section('content')
    @include('parts.session')
    <center>
        @foreach ($users as $u)
            <hr>

            <form action="{{ route('updateUser') }}" method="POST">
                Name:
                {{$u->name }}
                <br>
                E-mail:
                {{$u->email }}
                <br>
                <input type="hidden" name="id" value="{{ $u->id }}">

                <br>
                User roles:
                <br>
             {{--   User: <input type="checkbox" {{ $u->checkRole('role_user') ? 'checked' : '' }} name="role_user">--}}
                User:(You can't uncheck this role) <input type="checkbox" checked disabled>
                Moderator: <input type="checkbox" {{ $u->checkRole('role_moderator') ? 'checked' : '' }} name="role_moderator">
                Admin: <input type="checkbox" {{ $u->checkRole('role_admin') ? 'checked' : '' }} name="role_admin">

                <h3 style="color: red;">NOTE: If you uncheck this field user will be deactivated.And user will not be able to log in.</h3>

                Activate or deactivate user:
                <br>
                <input type="checkbox" {{ $u->is_active==1 ? 'checked' : '' }} name="is_active">
                {{ csrf_field() }}
                <br>
                <button type="submit">Update user</button>

            </form>
            <hr>
        @endforeach
        {{ $users->links() }}
    </center>

@endsection


