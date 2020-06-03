@extends('layouts.app')

@section('content')
 <div class="container">
     <div class="row">
         <div class="col-md-1"></div>
        <div class="card  col-md-6">
            <div class="card-body">
                @if(count($posts)>0)
                    @foreach($posts->all() as $post)
                        <div class="container">{{$post->idPost}}
                            <img class="align-content-center" src="{{ $post->post_image }}" style="width:400px; height:450px;">
                        </div>
                    @endforeach
                @else
                    <p>No Post Available</p>
                @endif

            </div>
        </div>
        <div class="card col-md-4">
            <div class="card-header row">
                @foreach($profile as $profiles)
                    <div class="col-md-3">
                        <img class="rounded" src="{{$profiles->profile_pic}}" alt="" style="height:50px;width:50px; ">
                    </div>
                    <div class="col-md-5">
                        <h4>{{$profiles->name}}</h4>
                        <p>{{$profiles->designation}}</p>
                    </div>
                @endforeach
            </div>
            <div class="card-body row">
                <div class="col-md-3">
{{--                    @foreach($comments as $comment)--}}
{{--                        <span>{{$comment->comments}}</span>--}}
{{--                    @endforeach--}}
                </div>
                <div class="col-md-9">
                    @foreach($comments as $comment)
                        <span>{{$comment->comments}}</span>
                    @endforeach
                </div>
            </div>
        </div>
         <div class="col-md-1"></div>
     </div>
 </div>
@endsection