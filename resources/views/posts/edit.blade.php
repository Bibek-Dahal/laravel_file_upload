@extends('layouts.blog')
@section('title', 'homepage')
@section('extarlinks')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
<script src="{{ asset('js/edit.js') }}" defer></script>
@endsection
@section('container')
    <div class="container-fluid">
        <h1 class="alert alert-danger text-center p-0 mx-0">Update post</h1>
        <div class="row">
            <div class="col-4 shadow">
                
                <form action="{{route('posts.update',['post'=>$post->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" value="{{ $post->title }}"
                            name="title">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" value="{{ $post->description }}"
                            name="description">
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        {{-- <img class="img-viewer img-fluid" src="{{asset('storage/'.$post->photo)}}" alt=""> --}}
                        <img class="img-viewer img-fluid" src="{{$post->photo}}" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Image</label>
                        <input type="file" accept="image/*" class="form-control" id="photo" name="photo">
                        @error('photo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <button type="update" class="btn btn-primary">Submit</button>
                </form>
            </div>
            
        </div>
    </div>
@endsection
