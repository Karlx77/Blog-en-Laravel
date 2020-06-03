@extends('layouts.app')

@section('content')
    <style type="text/css">
        .avatar{
            border-radius: 100%;
            max-width: 100px;

        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">Post View</div>
                    <div class="card-body">
                        @if(count($posts)>0)
                            @foreach($posts->all() as $post)

                            <div class="card mb-3" style="max-width: 740px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ $post->post_image }}" alt="" width="230" height="210">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$post->name}}</h5>
                                        <h4>{{ $post->post_title }}</h4>
                                        <p class="card-text">{{$post->post_body}}</p>
                                        <p class="card-text"><small class="text-muted">
                                                <div class="row">
                                                    <ul class="nav nav-pills">
                                                        <li role="presentation">
                                                            <a class="btn btn-link" href="{{route('dislike',$post->pos)}}">
                                                                <img src="{{url('images/like.png')}}" alt="" style="height:35px;width:35px; ">
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a class="btn btn-link" href="">
                                                                <img src="{{url('images/message.png')}}" alt="" style="height:35px;width:35px; ">
                                                            </a>
                                                        </li>
                                                    </ul>
{{--                                                    <form action="" method="post">--}}
{{--                                                        <label for="">Comentar</label>--}}
{{--                                                        <textarea rows="2" type="text"></textarea>--}}
{{--                                                        <a class="btn btn-link" href="">--}}
{{--                                                            <button type="submit" class="btn btn-primary">Enviar</button>--}}
{{--                                                        </a>--}}
{{--                                                    </form>--}}
                                                </div>
                                            </small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        @else
                            <p>No Post Available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
