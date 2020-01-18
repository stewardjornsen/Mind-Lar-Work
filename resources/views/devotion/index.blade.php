@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6"></div>
    </div>
    <div class="row">
        @if (Route::currentRouteName() == "devotion.edit")
        <div class="col-md-6">
            {{-- {{ \Carbon\Carbon::now() }} --}}


            <h3>DEVOTIONALS</h3>
            <h5>Edit the Devotional for this Date</h5>
            <hr>
            @if (Session::has('status'))
            <div class="alert alert-success my-3" role="alert">
                {{ Session::get('status') }}
            </div>

            @endif

            @horizontal(['model'=>$devotion, 'store' => 'devotion.store', 'update'=>'devotion.update', 'files' => true])
            @text('topic', 'Topic *')
            @text('bible_ref', 'Bible Reference *')
            @textarea('study', 'Study *')
            @date('devotion_date', 'Devotion Date *', null)
            @text('top_quote', 'Top Quote')
            @textarea('prayers', 'Prayers')
            @textarea('further_reading', 'Further Reading')
            @text('author', 'Author')

            @file('photo', 'Photo', ['custom'=> true])

            @if (isset($devotion->photo) && file_exists(public_path('thumbnails/posts/'.$devotion->photo)))
            <div class="row">
                <div class="col-4"></div>
                <div class="col-8"> <img src="{{ asset('thumbnails/posts/'.$devotion->photo) }}" class="pb-4"
                        style="max-width:100px" alt=""></div>
            </div>
            @endif
            {{-- @text('user_id', null) --}}
            @submit('Submit')
            @close
            <hr class="my-5">
        </div>
        @endif
        <div class="col-md-6">
            <h3> {{ $monthName}}</h3>
            @php
            $today = \Carbon\Carbon::now()->isoFormat('ddd D MMM, Y');
            @endphp
            Today's Date: {{ \Carbon\Carbon::now()->isoFormat('dddd D MMMM, Y') }}
            <hr>
            <table class="table table-striped table-bordered table-dark">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Topic</th>
                        <th>Bible Reference</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devotionRecords as $record)
                    <tr
                        class="{{ ($today == \Carbon\Carbon::create($record->devotion_date)->isoFormat('ddd D MMM, Y')) ? "bg-light text-dark font-weight-bolder": ""}}">
                        <td scope="row">{{ \Carbon\Carbon::create($record->devotion_date)->isoFormat('ddd D MMM, Y') }}
                        </td>
                        <td>{{ $record->topic }}</td>
                        <td>{{ $record->bible_ref }}</td>
                        <td><a href="{{route('devotion.edit', $record->id)}}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
