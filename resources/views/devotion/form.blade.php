@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @horizontal(['model'=>$post, 'store' => 'post.store', 'update'=>'post.update', 'files' => true])
            @text('title', 'Title')
            @text('subtitle', 'Sub Title')
            @textarea('textcontent', 'content')
            @textarea('htmlcontent', 'Html Text')
            @file('featured_image', 'Featured Image', ['custom'=> true])

            @if (file_exists(public_path('thumbnails/posts/'.$post->featured_image)))
            <div class="row">
                <div class="col-4"></div>
                <div class="col-8"> <img src="{{ asset('thumbnails/posts/'.$post->featured_image) }}" class="pb-4"
                        style="max-width:100px" alt=""></div>
            </div>
  @endif

            @file('banner_image', 'Banner Image', ['custom' => true])
            @if (File::exists(public_path('thumbnails/posts/'.$post->banner_image)))
            <div class="row">
                <div class="col-4"></div>
                <div class="col-8"> <img src="{{ asset('thumbnails/posts/'.$post->banner_image) }}" class="pb-4"
                        style="max-width:100px" alt=""></div>
            </div>
     @endif

            @text('author', 'Author')
            @text('user_id', null)
            @submit('Submit')
            @close
        </div>
        <div class="col-md-6">

        </div>
    </div>
</div>
@endsection
