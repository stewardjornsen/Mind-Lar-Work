<?php

namespace App\Http\Controllers;

use App\Devotion;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DevotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $devotion = "Devotion";
        $dt = Carbon::now();
        $month = $dt->month;
        $monthName = $dt->monthName;
        $year = $dt->year;

        $from = Carbon::now()->subDays(7);
        $to = Carbon::now()->addDays(14);
        $period = CarbonPeriod::create($from, $to);


        $db = Devotion::select('devotion_date')->get();
        $db_array = [];
        foreach ($db as $item) {
            $db_array[] = $item->devotion_date;
        }
        // dump($db);
        // dump($db_array);

        foreach ($period as $date) {
            $theDate = $date->format('Y-m-d');
            $find = ["devotion_date" =>  $theDate];
            $data = [
                "topic" => "Topic",
                "study" => "Studies",
                "bible_ref" => "Bible Reference",
                "devotion_date" =>  $theDate,
            ];

            if (!in_array($theDate, $db_array) || empty($db_array) ) {
                $record = new Devotion($data);
                $record->save();
                //  dump($theDate);
            }
        }

        $devotionRecords = Devotion::whereBetween('devotion_date', [$from->format('Y-m-d'), $to->format('Y-m-d')])->orderBy('devotion_date', 'asc')->get();
        return view('devotion.index')->with(compact(['devotion', 'month', 'year', 'monthName', 'devotionRecords']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Devotion  $devotion
     * @return \Illuminate\Http\Response
     */
    public function show(Devotion $devotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Devotion  $devotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Devotion $devotion)
    {
        // $devotion = "Devotion";
        $dt = Carbon::now();
        $month = $dt->month;
        $monthName = $dt->monthName;
        $year = $dt->year;

        $from = Carbon::now()->subDays(7);
        $to = Carbon::now()->addDays(14);
        // $period = CarbonPeriod::create($from, $to);

        // foreach ($period as $date) {
        //     $data = [
        //         "topic" => "Topic",
        //         "study" => "Studies",
        //         "bible_ref" => "Bible Reference",
        //         "devotion_date" =>  $date->format('Y-m-d'),
        //     ];
        //     $record = Devotion::firstOrNew($data);
        //     $record->save();
        // }

        $devotionRecords = Devotion::whereBetween('devotion_date', [$from->format('Y-m-d'), $to->format('Y-m-d')])->orderBy('devotion_date', 'asc')->get();
        return view('devotion.index')->with(compact(['devotion', 'month', 'year', 'monthName', 'devotionRecords']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devotion  $devotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devotion $devotion)
    {
        $data = $request->validate(
            [
                'topic' => 'required|max:255',
                'study' => 'required|min:20',
                'bible_ref' => 'required',
                'devotion_date' => 'required|date',
                'top_quote' => '',
                'prayers' => '',
                'further_reading' => '',
                'author' => '',
                'photo' => 'image|mimes:jpeg,jpg,png',

            ]
        );

        $item = $devotion->update($data);
        // Session::flash(['msg'=>'Devotion Record Updated']);
        $request->session()->flash('status', 'Record Updated Successfully');
        return back()->withInput();
        // dd ($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Devotion  $devotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devotion $devotion)
    {
        //
    }
}
