<?php

namespace App\Http\Controllers;

use App\Festival;
use App\Http\Resources\Festival as FestivalResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FestivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $festivals = Festival::paginate(2);

        return FestivalResource::collection($festivals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return FestivalResource
     */
    public function store(Request $request)
    {
        $festival = $request->isMethod('put') ?
            Festival::findOrFail($request->festival_id) : new Festival;

        $festival->id = $request->input('festival_id');
        $festival->title = $request->input('title');
        $festival->address = $request->input('address');
        $festival->place_name = $request->input('place_name');
        $festival->date_from = $request->input('date_from');
        $festival->date_to = $request->input('date_to');
        $festival->description = $request->input('description');
        $festival->slug = $request->input('slug');
        $festival->country_id = $request->input('country_id');
        $festival->city_id = $request->input('city_id');
        $festival->cover = $request->input('cover');
        $festival->video = $request->input('video');
        $festival->link = $request->input('link');
        $festival->facebook = $request->input('facebook');

        if ($festival->save()) {
            return new FestivalResource($festival);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return FestivalResource
     */
    public function show($id)
    {
        $festival = Festival::findOrFail($id);

        return new FestivalResource($festival);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return FestivalResource
     */
    public function destroy($id)
    {
        $festival = Festival::findOrFail($id);

        if ($festival->delete())
            return new FestivalResource($festival);
    }
}
