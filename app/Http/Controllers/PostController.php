<?php

namespace App\Http\Controllers;

use Image;
use App\Post;
use App\CommonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //
    }

    public function json()
    {
        $post['posts'] = Post::all();
        return $post;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;
        return view('contents.postform')->with('post', $post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'textcontent' => 'required',
            'htmlcontent' => '',
            'featured_image' => 'nullable|mimes:jpeg,jpg,png,gif|max:100000',
            'banner_image' => 'nullable|mimes:jpeg,jpg,png,gif|max:100000',
            'author' => '',
            'user_id' => 'required'
        ]); //

        $featured_image = $this->upload($request, 'featured_image', 'MW_Post_featured_');
        $banner_image = $this->upload($request, 'banner_image', 'MW_Post_banner_');
        $validatedData['featured_image'] = $featured_image;
        $validatedData['banner_image'] = $banner_image;

        Post::create($validatedData);
        return back();

        dd($validatedData);

        // $post = new Post;
        // $post->title = $request->title;
        // $post->subtitle = $request->subtitle;
        // $post->textcontent = $request->textcontent;
        // $post->htmlcontent = $request->htmlcontent;
        // $post->featured_image = $request->featured_image;
        // $post->banner_image = $request->banner_image;
        // $post->author = $request->author;
        // $post->user_id = $request->user_id;

        // $post->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('contents.postform')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'textcontent' => 'required',
            'htmlcontent' => '',
            'featured_image' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
            'banner_image' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
            'author' => '',
            'user_id' => 'required'
        ]); //
        // $filename = null;
        // if ($files = $request->file('featured_image')) {
        //     $filename = time() . $files->getClientOriginalName();

        //     // for save original image
        //     $ImageUpload = Image::make($files);
        //     $originalPath = public_path('images/posts/');
        //     $ImageUpload->save($originalPath .  $filename);

        //     // for save thumbnail image
        //     $thumbnailPath = public_path('thumbnails/posts/');
        //     $ImageUpload->resize(250, 125);
        //     $ImageUpload = $ImageUpload->save($thumbnailPath .  $filename);

        //     $validatedData['featured_image'] = $filename;
        // }


        // dd($post->banner_image);
        $featured_image = $this->upload($request, 'featured_image', 'MW_Post_featured_');
        $banner_image = $this->upload($request, 'banner_image', 'MW_Post_banner_');

        if (!is_null($featured_image)) {
            $validatedData['featured_image'] = $featured_image;
            //Check and delete old image
            if (!is_null($post->featured_image)) {
                File::delete(public_path('images/posts/' . $post->featured_image), public_path('thumbnails/posts/' . $post->featured_image));
            }
        }

        if (!is_null($banner_image)) {
            $validatedData['banner_image'] = $banner_image;
            //Check and delete old image
            if (!is_null($post->banner_image)) {
                File::delete(public_path('images/posts/' . $post->banner_image), public_path('thumbnails/posts/' . $post->banner_image));
            }
        }



        $post->update($validatedData);
        return back();


        // $post->title = $request->title;
        // $post->subtitle = $request->subtitle;
        // $post->textcontent = $request->textcontent;
        // $post->htmlcontent = $request->htmlcontent;
        // $post->featured_image = $request->featured_image;
        // $post->banner_image = $request->banner_image;
        // $post->author = $request->author;
        // $post->user_id = $request->user_id;

        // $post->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }


    public function upload($request, $image, $prefix)
    {
        if ($files = $request->file($image)) {

            $originalName =  $files->getClientOriginalName();
            $ext = \File::extension($originalName);

            $filename = $prefix . time() . '.' . $ext;

            // for save original image
            $ImageUpload = Image::make($files);
            $originalPath = public_path('images/posts/');
            $ImageUpload->resize(960, 960, function ($constraint) {
                $constraint->aspectRatio();
            });
            $ImageUpload->save($originalPath .  $filename);

            // for save thumbnail image
            $thumbnailPath = public_path('thumbnails/posts/');
            $ImageUpload->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            });
            $ImageUpload = $ImageUpload->save($thumbnailPath .  $filename);

            return $filename;
        }
        return null;
    }
}
