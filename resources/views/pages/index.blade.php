@extends('main.main')

@section('Title', 'Sample project Home')

@section('content')

@include('parts.session')

    <center>
        <h1>If you have any questions or suggestions you can find me on social media , or email me on:</h1>

        <a href="http://www.instagram.com/_alleksaa_"><img
                    src="http://images.all-free-download.com/images/graphiclarge/instagram_new_icon_6822180.jpg"
                    class="img-responsive" alt="Responsive image" width="50" height="50"> </a>

        <a href="http://www.facebook.com/paleksa95"><img
                    src="https://s-media-cache-ak0.pinimg.com/originals/b3/26/b5/b326b5f8d23cd1e0f18df4c9265416f7.png"
                    class="img-responsive" alt="Responsive image" width="75" height="75"> </a>

        <a href="Github link"><img
                    src="https://image.flaticon.com/icons/svg/25/25231.svg"
                    class="img-responsive" alt="Responsive image" width="50" height="50"> </a>

        <img src="https://www.howitworksdaily.com/wp-content/uploads/2016/03/email-logo.jpg"
             class="img-responsive" alt="Responsive image" width="50" height="50" style="margin-top: 10px"
             data-toggle="tooltip" data-placement="bottom" title="paleksa95@gmail.com">
    </center>
@endsection