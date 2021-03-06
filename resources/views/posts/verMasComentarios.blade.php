@extends('layouts.app')

@section('content')
 <div class="container">
     <div class="row">
         <div class="col-md-1"></div>
        <div class="card  col-md-6">
            <div class="card-body">
                @if(count($posts)>0)
                    @foreach($posts->all() as $post)
{{--                        <div>--}}
                            <img class="img img-responsive" src="{{ $post->post_image }}" style="width:500px ;height:555px ; margin: 0px;">
{{--                        </div>--}}
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
                        <img class="rounded-circle" src="{{$profiles->profile_pic}}" alt="" style="height:50px;width:50px; ">
                    </div>
                    <div class="col-md-5">
                        <h4>{{$profiles->name}}</h4>
                        <p>{{$profiles->designation}}</p>
                    </div>
                @endforeach
            </div>

            <pre style="height:400px;white-space: normal">
            <div class="card-body " id="comentario">
                        <ul>
                            @foreach($comments as $comment)
                            <li class="row">
                                <div class="col-md-3">
                                    <p> <img class="rounded-circle" src="{{$comment->profile_pic}}" alt="" style="height:45px;width:45px ; "></p>
                                </div>
                                <div class="col-md-9">
                                    <p><b>{{$comment->name}}:  </b> {{$comment->comments}}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
            </div>
            </pre>
            <div class="card-footer">
                @if(count($posts)>0)
                    @foreach($posts->all() as $post)
                        <form action="{{route('comentar',$post->idPost)}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <input type="text" name="comentario" class="form-control col-md-9">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                @endif
            </div>
        </div>
         <div class="col-md-1">
         </div>
     </div>
 </div>
@endsection
