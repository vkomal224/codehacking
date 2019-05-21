<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Requests\PostCreateRequest;
use App\Post;
use App\User;
use App\Photo;
use App\Category;
use Illuminate\Http\Request;
use Auth;
class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::all();

      return View('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $categories = Category::lists('name','id')->all();
        return View('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        //
          $input= $request->all();
        $user= Auth::user();

        if($file = $request->file('photo_id'))
{
        $name = time(). $file->getClientOriginalName();

        $file->move('images', $name);
        $photo= Photo::create(['file'=>$name]);
        $input['photo_id']=$photo->id;
}
        $user->posts()->create($input);
        return redirect('/admin/posts');
        // return $request->all();
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
    {
        //
        $post= Post::findOrFail($id);
        $categories= Category::lists('name','id')->all();
        return View('admin.posts.edit', compact('post','categories'));

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
        //
        $input= $request->all();

        if($file=$request->file('photo_id'))
        {
          $name = time(). $file->getClientOriginalName();
          $file->move('images', $name);
          $photo= Photo::create(['file'=>$name]);

          $input['photo_id']= $photo->id;
        }

          Auth::user()->posts()->whereId($id)->first()->update($input);
          return redirect('\admin\posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        unlink(public_path() . $post->photo->file);
        $post->delete();
        Session::flash('duser','The user has been deleted!!');
        return redirect ('admin\posts');
        // return "It Works";
    }
}
