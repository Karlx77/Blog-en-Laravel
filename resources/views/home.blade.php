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
                <div class="card-body row">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-4">
                        @if(!empty($profile))
                            <img class="rounded mx-auto d-block" src="{{ $profile->profile_pic }}" class="avatar" alt=""  width="150px" height="150px">
                            <p class="lead text-center">{{ $profile->name }}</p>
                            <p class="text-center">{{ $profile->designation }}</p>
                        @else
                            <img src="{{ url('images/usuario.png') }}" class="avatar" alt=""  width="150px" height="150px"><br>
                        @endif
                    </div>
                    <div class="col-md-8">
                        @if(count($posts)>0)
                        @foreach($posts->all() as $post)
                            <h4 class="text-center">{{ $post->post_title }}</h4>
                            <img class="rounded mx-auto d-block" src="{{ $post->post_image }}" alt="" width="450" height="450">
                                <p class="text-center">{{ substr($post->post_body, 0, 150 )}}</p>
                                <ul class="nav nav-pills ">
                                    <li role="presentation" class="">
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
                                        <form action="{{route('posts.delete',$post)}}" method="post" class="">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-link fa fa-trash"> ELIMINAR</button>

                                        </form>

                                    </li>
                                </ul>
                                <cite style="float: left">Posted on: {{date('M j, Y H:i', strtotime($post->updated_at))}} </cite>
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
