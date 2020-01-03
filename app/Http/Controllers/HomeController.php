<?php

namespace App\Http\Controllers;

use App\Event;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('auth:api', ['except' => ['page', 'login']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $event = Event::whereDate('start_date', '>=', Carbon::now('Africa/Lagos'))
            ->orWhereDate('end_date', '>=', Carbon::now('Africa/Lagos'))
            ->orderBy('start_date', 'asc')->get()->first();

        dd($event);
        return view('mobile');
    }

    public function landing()
    {
        // $event = Event::next()->latest('end_date')->first(); //Scope from Model to pick most upcoming event
        // $upcomingevents = Event::upcoming()->get(); //Scope from Model to pick most upcoming event
        // $pastevents = Event::past()->get(); //Scope from Model to pick most upcoming event


        $allevents = Event::with(['post'])
            ->orderBy('start_date', 'asc')
            ->orderBy('end_date', 'asc')
            ->get(); //Scope from Model to pick most upcoming event

        //GET BANNER IMAGE
        $output['banner'] = Setting::find(1);


        //SET HOST URL;
        $output['app_url'] = env('APP_URL', 'http://localhost/');


        $output['allevents'] = $allevents;

        return ($output);


    }
    public function page()
    {

        return view('mobile');
    }
}
