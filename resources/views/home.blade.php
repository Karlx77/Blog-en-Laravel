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
<<<<<<< HEAD
                                <img class="rounded mx-auto d-block avatar" src="{{ $profile->profile_pic}}" alt=""  width="150px" height="150px">
=======
                                <img class="rounded-circle mx-auto  d-block avatar" src="{{ $profile->profile_pic }}" alt=""  width="150px" height="150px">
>>>>>>> f765e78e8fcd7e89b55155e697c00d22b63c5b5b
                                <p class="lead text-center">{{ $profile->name }}</p>
                                <p class="text-center">{{ $profile->designation }}</p>
                                    @else
                                <img src="{{ url('images/usuario.png') }}" class="avatar" alt=""  width="150px" height="150px"><br>
                                    @endif
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                @if(count($posts)>0)
                                    @foreach($posts->all() as $post)
                                <div class="card-body col-md-7">
                                      <img class="rounded mx-auto d-block" src="{{ $post->post_image }}" alt="" width="400" height="300">

                                </div>
                                <div class="card-body col-md-5"><br><br>
                                    <h4 class="">{{ $post->post_title }}</h4>
                                    <p class="">{{ $post->post_body}}</p>
                                    <ul class="nav nav-pills ">
                                        <li role="presentation">
                                            <a class="btn btn-link " href="{{route('posts.edit',$post)}}">
                                                <img src="{{url('images/update.png')}}" alt="" style="width:45px;height: 45px;">
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <form action="{{route('posts.delete',$post)}}" method="post" class="">
                                                @method('DELETE')
                                                @csrf
{{--                                                <a type="submit" class="btn btn-link">--}}
                                                <button class="btn btn-link" >
                                                   <img src="{{url('images/delete.png')}}" alt="" style="width:45px;height: 45px;">
                                                </button>
{{--                                                </a>--}}
                                            </form>
                                        </li>
                                    </ul>
                                    @foreach($disCtr as $item)
                                        @if($item->likes ==1)
                                            <span> Les gusta a {{$item->likes}} persona</span>
                                        @else
                                            <span> Les gusta a {{$item->likes}} personas</span>
                                        @endif
                                    @endforeach
                                    <cite style="float: left">Posted on: {{date('M j, Y H:i', strtotime($post->updated_at))}} </cite> <br>

                                </div>
                                @endforeach
                                @else
                                    <p>No Post Available</p>
                                @endif
                            </div>
                            <br>
                            {{$posts->links()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
