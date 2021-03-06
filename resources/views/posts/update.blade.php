@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="">
                            <form method="POST" action="{{ route('posts.update',$posts->id) }}" enctype="multipart/form-data">
                               @method('PUT')
                                @csrf

                                <div class="form-group row">
                                    <label for="post_title" class="col-md-4 col-form-label text-md-right">{{ __('Enter Title') }}</label>

                                    <div class="col-md-6">
                                        <input id="post_title" type="text" class="form-control @error('post_title') is-invalid @enderror" name="post_title" value="{{ $posts->post_title }}" required autocomplete="post_title" autofocus>

                                        @error('post_title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="post_body" class="col-md-4 col-form-label text-md-right">{{ __('Enter Body') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="post_body" rows="7" class="form-control @error('post_body') is-invalid @enderror" name="post_body" required autocomplete="post_body">{{$posts->post_body}}
                                        </textarea>
                                        @error('post_body')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="post_image" class="col-md-4 col-form-label text-md-right">{{ __('Enter Picture') }}</label>

                                    <div class="col-md-6">
                                        <input id="post_image" type="file" class="form-control @error('post_image') is-invalid @enderror" name="post_image" required autocomplete="current-designation">

                                        @error('post_image')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary btn-large btn-block">
                                            {{ __('Update Post') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
