<?php

namespace FgutierrezPHP\AddresesRd\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use FgutierrezPHP\AddresesRd\Traits\InteractsWithHttpResponse;
use FgutierrezPHP\AddresesRd\Http\Filters\ProvinceFilter;
use FgutierrezPHP\AddresesRd\Models\Province;
// use App\Http\Requests\ProvinceRequest;
// use App\Http\Resources\ProvinceResource;

class ProvinceController extends Controller
{
    use InteractsWithHttpResponse;

    // public function get(ProvinceFilter $filter)
    // {
    //     $provinces = [];
    //     if(request()->paginate){
    //         $provinces = Province::filter($filter)->paginate(10);
    //     }else{
    //         $provinces = Province::filter($filter)->get();
    //     }
    //     return ProvinceResource::collection($provinces);
    // }

    // public function store(ProvinceRequest $request)
    // {
    //     try {
    //         Province::create([
    //             'name' => $request->name,
    //             'created_by' => auth()->user()->id
    //         ]);
    //         return response()->noContent();
    //     } catch (\Exception $e) {
    //         return $this->error($e->getMessage());
    //     }
    // }

    // public function update(ProvinceRequest $request, Province $province)
    // {
    //     try {
    //         $province->update([
    //             'name' => $request->name,
    //         ]);
    //         return response()->noContent();
    //     } catch (\Exception $e) {
    //         return $this->error($e->getMessage());
    //     }
    // }
}
