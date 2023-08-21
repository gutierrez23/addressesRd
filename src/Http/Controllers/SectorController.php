<?php

namespace FgutierrezPHP\AddresesRd\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Filters\MunicipalityFilter;
use App\Http\Filters\SectorFilter;
use App\Http\Requests\SectorRequest;
use App\Http\Resources\SectorResource;
use App\Models\Sector;
use App\Traits\InteractsWithHttpResponse;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    use InteractsWithHttpResponse;
    
    public function index()
    {
        return view('locations.sectors.index');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(SectorFilter $filter)
    {
        $sectors = [];
        if(request()->paginate){
            $sectors = Sector::filter($filter)->paginate(10);
        }else{
            $sectors = Sector::filter($filter)->get();
        }
        return SectorResource::collection($sectors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectorRequest $request)
    {
        try {
            Sector::create($request->safe()->all());
            return response()->noContent();
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SectorRequest $request, Sector $sector)
    {
        try {
            $sector->update($request->safe()->all());
            return response()->noContent();
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
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
}
