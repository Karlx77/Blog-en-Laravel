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
                    <div class="card-body row">

                        <div class="col-md-4">
                            <ul>
                                @foreach($categories as $item)
                                <li class="list-group-item"><a href="{{route('posts.category',$item)}}" class=" btn btn-link">{{$item->category}}</a> </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-8">
                            @if(count($posts)>0)
                                @foreach($posts->all() as $post)
                                    <h4>{{ $post->post_title }}</h4>
                                    <img src="{{ $post->post_image }}" alt="" width="450" height="450">
                                    <p>{{$post->post_body}}</p>
                                    <ul class="nav nav-pills">
                                        <li role="presentation">
                                            <a class="btn btn-link" href="{{url('like',$post)}}">
                                                <span class=" fa fa-thumbs-up"> Like()</span>
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="btn btn-link" href="url('like',$post)">
                                                <span class="fa fa-thumbs-down"> Dislike()</span>
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a class="btn btn-link" href="">
                                                <span class=" fa fa-comment"> Comment()</span>
                                            </a>
                                        </li>
                                    </ul>
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
@endsection
