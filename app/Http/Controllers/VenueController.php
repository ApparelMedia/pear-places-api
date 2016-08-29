<?php

namespace App\Http\Controllers;

use App\SponsoredLocation;
use Illuminate\Http\Request;

use App\Http\Requests;

class VenueController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = SponsoredLocation::find($id);

        // TODO got through a transformer

        return response()->json(['data' => $location]);
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
        $venue = $request->get('venue');
        $location = SponsoredLocation::find($id);

        //TODO set properties

        $location->save();
        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function batchCreate(Request $request)
    {
        $venues = $request->get('venues');

        //TODO transform request to model properties

        SponsoredLocation::insert($venues);
    }
}
