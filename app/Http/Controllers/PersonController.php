<?php

namespace App\Http\Controllers;

use Image;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PersonController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        App::bind('path.public', function() {
    return base_path().'/public_html/stewardjornsen.com/';
});
        dd(public_path());
        $person = new Person;
        return view('contents.personform')->with(compact('person') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'fullname' => 'required|max:255',
        //     'title' => 'required|max:255',
        //     'profile' => 'required',
        //     'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
        //     'cover' => 'image|mimes:jpeg,png,jpg,gif,svg',

        // ]);//

        $validatedData = $this->validating($request);

        $photo = $this->upload($request, 'photo');
        $cover = $this->upload($request, 'cover');

        $person = new Person;
        $person->fullname = $request->fullname;
        $person->stage_name = $request->stage_name;
        $person->title = $request->title;
        $person->profile = $request->profile;
        $person->website = $request->website;
        $person->mobile = $request->mobile;
        $person->facebook = $request->facebook;
        $person->twitter = $request->twitter;
        $person->youtube = $request->youtube;
        $person->instagram = $request->instagram;
        $person->photo = $photo;
        $person->cover = $cover;

        $person->save();
        return redirect()->route('person.edit', $person->id)->with('success', 'Record saved successfully');
        // return back()->with('success', 'Record saved successfully');


        dd($cover, $photo);


    }

    private function validating(Request $request){
        $validatedData = $request->validate([
            'fullname' => 'required|max:255',
            // 'title' => 'required|max:255',
            'profile' => 'required',
            'mobile' => 'max:15',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg',

        ]);//
    }

    public function upload($request, $field){

        // dd($request)
        if (!$request->file($field))
        return null;

        $originalImage = $request->file($field);
        $thumbnailImage = Image::make($originalImage);

        $filename = $originalImage->getClientOriginalName();
        $ext = \File::extension($filename);
        $newfilename =   'MW_img_person_'. time() . '.'.$ext;


        $thumbnailPath = public_path('thumbnails/');
        $originalPath = public_path('images/');

        $thumbnailImage->resize(1920, 1080, function ($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $thumbnailImage->save($originalPath .  $newfilename);
        $thumbnailImage->resize(250, 250, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $thumbnailImage->save($thumbnailPath .  $newfilename);

        return $newfilename;

        // dd($thumbnailImage);
        // $imagemodel = new Person();
        // $imagemodel->cover =   $newfilename;
        // $imagemodel->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        // $person = new Person;
        return view('contents.personform')->with(compact('person')); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {

        $validatedData = $this->validating($request);


        // Delete Photo if checkboxes are true

        if ($request->delete_cover OR $request->file('cover'))
        {
            $image_path =  public_path("images/".$request->delete_cover_filename);  // Value is not URL but directory file path
            $thumbpath_path =  public_path("thumbnails/".$request->delete_cover_filename);  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
                $person->cover = null;
            }
            if (File::exists($thumbpath_path)) {
                File::delete($thumbpath_path);
                $person->cover = null;
            }
        }
        if ($request->delete_photo OR  $request->file('photo'))
        {
            $image_path =  public_path("images/".$request->delete_photo_filename);  // Value is not URL but directory file path
            $thumbpath_path =  public_path("thumbnails/".$request->delete_photo_filename);  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
                $person->photo = null;
            }
            if (File::exists($thumbpath_path)) {
                File::delete($thumbpath_path);
                $person->photo = null;
            }
        }


        $photo = $this->upload($request, 'photo');
        $cover = $this->upload($request, 'cover');

        // dd($request);

        // $person = new Person;
        $person->fullname = $request->fullname;
        $person->stage_name = $request->stage_name;
        $person->title = $request->title;
        $person->profile = $request->profile;
        $person->website = $request->website;
        $person->mobile = $request->mobile;
        $person->facebook = $request->facebook;
        $person->twitter = $request->twitter;
        $person->youtube = $request->youtube;
        $person->instagram = $request->instagram;
        if ($photo)
        $person->photo = $photo;
        if ($cover)
        $person->cover = $cover;

        $person->save();
        return back()->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }
}
