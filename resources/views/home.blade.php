@extends('layouts.blog')
@section('title', 'homepage')

@section('container')
    <div class="container-fluid">
        <h1 class="alert alert-danger text-center p-0 mx-0">Student CRUD</h1>
        <div class="row">
            <div class="col-md-4 shadow p-3">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="title" class="form-control" id="title" value="{{ old('title') }}" name="title">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="description" class="form-control" id="description" value="{{ old('description') }}"
                            name="description">
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Image</label>
                        <input type="file" accept="image/*" class="form-control" id="photo" value="{{ old('photo') }}"
                            name="photo">
                        @error('photo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">title</th>
                            <th scope="col">description</th>
                            <th scope="col">photo</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <th scope="row">{{$post->id}}</th>
                                <td>{{$post->title}}</td>
                                <td>{{$post->description}}</td>
                                {{-- <td><div ><img style="height:50px;width:50px; border-radius:50%" src="{{asset('storage/'.$post->photo)}}" alt=""></div></td> --}}
                                <td><div ><img style="height:50px;width:50px; border-radius:50%" src="{{$post->photo}}" alt=""></div></td>
                                
                                <td>
                                    <a href="{{route('posts.edit',['post'=>$post->id])}}" class="btn btn-primary">
                                        {{-- @method('PUT') --}}
                                        {{-- @csrf --}}

                                        edit
                                    </a>
                                    <form action="{{route('posts.destroy',['post'=>$post->id])}}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger" value="delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
