@extends('layouts.app')

@section('content')
<div class="container">

    @horizontal(['model'=>$person, 'store' => 'person.store', 'update'=>'person.update', 'files' => true])
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @text('fullname', 'Full name*')
            @text('stage_name', null)
            @text('title', 'Title/Desc')
            @textarea('profile', 'Profile/Bio*', null, ['class'=>'editor_'])
            @text('mobile', null)
            @text('website', null)
            @text('facebook', null)
            @text('twitter', null)
            @text('youtube', null)
            @text('instagram', null)
            @hidden('id', null)
        </div>
        <div class="col-md-6">

            @submit('Submit')
            @reset()
            @link(route('person.create'), 'Add New', 'secondary')
@if(file_exists(public_path('thumbnails/'.$person->photo)))
            <div>
                <img src="{{ asset('thumbnails/'.$person->photo) }}" class="mb-3 mt-3" alt="">
                @checkbox('delete_photo', 'Delete Photo', $person->photo, null, ['switch' => true])
                @hidden('delete_photo_filename', $person->photo)
            </div>
@endif
            @file('photo', 'Profile Photo', ['custom'=> true])

@if(file_exists(public_path('thumbnails/'.$person->cover)))
            <div>
                <img src="{{ asset('thumbnails/'.$person->cover) }}" class="mb-3 mt-3" alt="">
                @checkbox('delete_cover', 'Delete Cover', $person->cover, null, ['switch' => true])
                @hidden('delete_cover_filename', $person->cover)
            </div>
@endif

            @file('cover', 'Cover Image', ['custom' => true])

        </div>
        @close

    </div>
</div>

{{-- $table->string('fullname');
$table->string('title')->nullable();
$table->string('stage_name')->nullable();
$table->mediumText('profile')->nullable();
$table->string('photo')->nullable();
$table->string('cover')->nullable();
$table->string('website')->nullable();
$table->string('mobile')->nullable();
$table->string('facebook')->nullable();
$table->string('twitter')->nullable();
$table->string('youtube')->nullable();
$table->string('instagram')->nullable(); --}}
@endsection
