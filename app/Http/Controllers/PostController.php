<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

   


    public function show(Post $post){
        // dd($id);

        // $post = Post::findOrFail($id);

        return view('blog-post',['post'=>$post]);

    }

    public function create()
    {
        return view('admin/posts/create');
    }
    
    
     public function store(){

        // $this->authorize('create', Post::class);

        $inputs = request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=> 'file',
            'body'=> 'required'
        ]);
        if($file = request('post_image')){
              $name = $file->getClientOriginalName();
            $file->move('uploads',$name);
            
            $inputs['post_image'] = $name;


           
        }
        auth()->user()->posts()->create($inputs);

        session()->flash('post-created-message', 'Post with title was created " '. $inputs['title']. ' "');

        return redirect()->route('post.index');

    }


    public function index()
    {
        // display all author/owner posts
        // $posts = Post::all()->paginate(5);

        // display only loged in author/owner data
        $posts = auth()->user()->posts()->paginate(3);

        // dd($posts);

        return view('admin/posts/index',['posts'=>$posts]);
    }
   
    public function delete(Post $post,Request $request)
    {

        $post->delete();

        $request->session()->flash('message','Post was Deleted');

        return back();   

    }

    public function edit(Post $post,Request $request)
    {

        // $posts = Post::findOrFail($post);
        // $this->authorize('view',$post);
        return view('admin.posts.edit',['posts'=>$post]);


    }


     public function update(Post $post){

        // $this->authorize('create', Post::class);
        // $post = new Post();
        $inputs = request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=> 'file',
            'body'=> 'required'
        ]);
        if($file = request('post_image')){
              $name = $file->getClientOriginalName();
            $file->move('uploads',$name);
            
            $inputs['post_image'] = $name;

            $post->post_image = $inputs['post_image'];
           
        }

            $post->title = $inputs['title'];
            $post->body = $inputs['body'];

        // dd($inputs);

        // onwer author is changes as per the current 
        // auth()->user()->posts()->save($post);


        // $this->authorize('update',$post);
        // owner author is not changed
        $post->save();

        session()->flash('post-updated-message', 'Post with title was updated " '. $inputs['title']. ' "');

        return redirect()->route('post.index');

    }

}
