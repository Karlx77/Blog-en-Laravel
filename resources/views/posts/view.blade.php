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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Post View</div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="card align-content-center col-md-6">
                                <div class="card-header">
                                    @if(count($posts)>0)
                                        @foreach($posts->all() as $post)
                                        <h3>{{$post->name}}</h3>
                                </div>
                                <div class="card-body">
                                            <img src="{{ $post->post_image }}" alt="" width="450" height="450">
                                </div>
                                <div class="card-footer ">
                                   <h4>{{ $post->post_title }}</h4>
                                    <p>{{$post->post_body}}</p>
                                    <ul class="nav nav-pills">
                                        <li role="presentation">
                                            <a class="btn btn-link" href="">
                                                <img src="{{url('images/like.png')}}" alt="" style="height:35px;width:35px; ">
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="btn btn-link" href="">
                                                <img src="{{url('images/message.png')}}" alt="" style="height:35px;width:35px; ">
                                            </a>
                                        </li>
                                    </ul>
{{--                                    <span>{{$disCtr}} me gusta</span>--}}
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
        </div>
    </div>
@endsection
