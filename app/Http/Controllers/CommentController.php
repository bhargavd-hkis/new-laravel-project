<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use DataTables;

use Illuminate\Support\Facades\Auth;
use App\DataTables\CommentDataTable;    

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index',['comments'=>$comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user= Auth::user();

        $data = [

            'post_id'=>$request->post_id,
            'author'=>$user->name,
            'email'=>$user->email,
            'file'=>$user->avatar,
            'is_active'=>'1',
            'body'=>$request->body

        ];

        Comment::create($data);

        $request->session()->flash('comment_message','Comment has been submitted');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        // dd($post->comments);
        $comments = $post->comments;
            // dd($comments);
       return view('admin.comments.show',compact('comments')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        
        $data = [
            'is_active'=>$request->is_active

        ];

        $comment = Comment::findOrFail($id)->update($data);
        // dd($data);
        // $comment->update($data);

        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::findOrFail($id)->delete($id);

        session()->flash('comment-delete','Your Comment has been deleted');

        return true;
    }


    

// public function show_datatable()
//     {
//     $model = Comment::with('post');
//     return DataTables::eloquent($model)
//                 ->addColumn('post', function (Comment $comment) {
//                     return $comment->post->title;
//                 })
//                 ->toJson();
//                 return view('users');

//     }

    
//      public function show_data(Request $request)
//     {
//          dd($request->ajax());
//         if ($request->ajax()) {

           
//             // $model = Comment::all();
//             //     return DataTables::eloquent($model)
//             //     ->addColumn('comments', function (Comment $comment) {

//             //         $data = [

//             //             'title'=>$comment->posts->title,
//             //             'id'=>$comment->posts->id

//             //         ];

//             //         return $data;
//             //     })
//             //     ->toJson();
//         }
//         return view('users');
//     }



    public function show_datatables(CommentDataTable $dataTable)
    {
        // dd($dataTable);
         return $dataTable->render('users');
    }
    
}
