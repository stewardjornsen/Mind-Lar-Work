@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @open(['route' => 'post.store', 'files' => true])
            @text('title', 'Title')
            @text('subtitle', 'Sub Title')
            @textarea('textcontent', 'content')
            @textarea('htmlcontent', 'Html Text')
            @file('featured_image', 'Featured Image', ['custom'=> true])
            @file('banner_image', 'Banner Image', ['custom' => true])
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