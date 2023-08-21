<?php

namespace FgutierrezPHP\AddresesRd\Http\Controllers;

use App\Http\Controllers\Controller;

use FgutierrezPHP\AddresesRd\Http\Filters\MunicipalityFilter;
use FgutierrezPHP\AddresesRd\Http\Requests\MunicipalityRequest;
use FgutierrezPHP\AddresesRd\Http\Resources\MunicipalityResource;
use FgutierrezPHP\AddresesRd\Models\Municipality;
use FgutierrezPHP\AddresesRd\Traits\InteractsWithHttpResponse;
use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
    use InteractsWithHttpResponse;
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(MunicipalityFilter $filter)
    {
        $municipalities = [];

        if(request()->paginate){ 
            $municipalities = Municipality::filter($filter)->paginate(10);
        }else{
            $municipalities = Municipality::filter($filter)->get();
        }
        return MunicipalityResource::collection($municipalities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunicipalityRequest $request)
    {
        try {
            $max = Municipality::max('municipio_id');
            Municipality::create([
                'province_id' => $request->province_id,
                'name' => $request->municipio,
                'municipio_id' => $max + 1
            ]);
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
    public function update(MunicipalityRequest $request, Municipality $municipality)
    {
        try {
            $municipality->update([
                'province_id' => $request->province_id,
                'name' => $request->municipio,
            ]);
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
