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
                @if(count($errors)>0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                @if(session('response'))
                    <div class="alert alert-success">
                        {{session('response')}}
                    </div>
                @endif
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-4">
                        @if(!empty($profile))
                            <img src="{{ $profile->profile_pic }}" class="avatar" alt=""  width="150px" height="150px"><br>
                            <p class="lead">{{ $profile->name }}</p>
                            <p >{{ $profile->designation }}</p>
                        @else
                            <img src="{{ url('images/usuario.png') }}" class="avatar" alt=""  width="150px" height="150px"><br>
                        @endif
                    </div>
                    <div class="col-md-8">
                        @if(count($posts)>0)
                            @foreach($posts->all() as $post)
                                <h4>{{ $post->post_title }}</h4>
                                <img src="{{ $post->post_image }}" alt="" width="450" height="450">
                                <p>{{ substr($post->post_body, 0, 150 )}}</p>
                                <ul class="nav nav-pills">
                                    <li role="presentation">
                                        <a class="btn btn-link" href="{{route('posts.view',$post)}}">
                                            <span class=" fa fa-eye"> VIEW</span>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a class="btn btn-link" href="{{route('posts.edit',$post)}}">
                                            <span class="fa fa-edit"> EDIT</span>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a class="btn btn-link" href="">
                                            <span class=" fa fa-trash-alt"> DELETE</span>
                                        </a>
                                    </li>
                                </ul>
                                <cite style="float: left">Posted on: {{date('M j, Y H:i', strtotime($post->updated_at))}}</cite>
                                <hr>
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
