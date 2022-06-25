<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Group;
use Illuminate\Support\Str;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Cloudinary;

use URLify;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::all();
        
        return view('home',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|max:255|min:4',
            'description' => 'required',
            'photo'=>'required|file|max:1000|min:50',
            
        ]);
        // $path = $request->file('photo')->store('photos');
        $path = $request->photo->path();;
        $res = (new UploadApi())->upload($path,[
            'folder' => 'laravel'
        ]);
        // dd($res['url']);
        $post = new Post([
            'title'=>$request->title,
            'description'=>$request->description,
            'slug'=>Str::slug ($request->title),
            'photo'=>$res['url']
        ]);
        $request->user()->posts()->save($post);
        // Post::create([
        //     'title'=>$request->title,
        //     'description'=>$request->description,
        //     'slug'=>Str::slug ($request->title),
        //     'photo'=>$path
        // ]);
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   echo "hello i am cadded";
        $post = Post::find($id);
        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $post = Post::find($id);
        $validated = $request->validate([
            'title' => 'required|max:255|min:4',
            'description' => 'required',
            // 'photo'=>'file|max:1000|min:50',
            
        ]);
        
        if($request->hasFile('photo')){
            
            $arr = explode('/',$post->photo);
            $pub_id_with_ext = end($arr);
            $public_id = explode('.',$pub_id_with_ext);
            // dd($public_id[0]);
            $cloudinary = new Cloudinary();
            $cloudinary->uploadApi()->destroy('laravel/'.$public_id[0]);
            $path = $request->photo->path();;
            $res = (new UploadApi())->upload($path,[
                'folder' => 'laravel'
            ]);
            $post->photo = $res['url'];
        }
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        return redirect('/')->with('status','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $post = Post::find($id);
        // Storage::delete($post->photo);
        $arr = explode('/',$post->photo);
        $pub_id_with_ext = end($arr);
        $public_id = explode('.',$pub_id_with_ext);
        // dd($public_id[0]);
        $cloudinary = new Cloudinary();
        $cloudinary->uploadApi()->destroy('laravel/'.$public_id[0]);
        $post->delete();
        return redirect('/')->with('status','Deleted Successfully');
    }
}
