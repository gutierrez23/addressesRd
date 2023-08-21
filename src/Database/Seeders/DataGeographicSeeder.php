<?php
namespace FgutierrezPHP\AddresesRd\Database\Seeders;

use FgutierrezPHP\AddresesRd\Models\Municipality;
use FgutierrezPHP\AddresesRd\Models\Province;
use FgutierrezPHP\AddresesRd\Models\Sector;
use FgutierrezPHP\AddresesRd\Models\SectorTemp;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class DataGeographicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Province::truncate();
            Municipality::truncate();
            Sector::truncate();
            
            $this->insertProvinces('data/provinces.json');

            if(Province::count()){
                $this->insertMunicipalities('data/municipios.json');
            }
            if(Municipality::count()){
                $this->insertSector('data/sectores.json');
            }
            dd(config('addreses_rd.tables_prefix').'sector_temps');
            Schema::dropIfExists(config('addreses_rd.tables_prefix').'sector_temps');
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
    }

    protected function insertProvinces($file){
        $content    = Storage::disk('local')->get($file);
        $json       = json_decode($content, true);
        collect($json)->map(function($province) { 
            Province::create([
                'name' => $province['provincia'],
                'province_id' => $province['provincia_id'],
            ]);
        });
    }

    protected function insertMunicipalities($file){
        $content    = Storage::disk('local')->get($file);
        $json       = json_decode($content, true);
        $provinces  = Province::all();
        collect($json)->map(function($municipality) use ($provinces) {
            collect($provinces)->contains(function ($value, $key) use ($municipality) {
                if($value->province_id === $municipality['provincia_id']){
                    Municipality::create([
                        'name' => $municipality['minicipio'],
                        'province_id' => $value->id,
                        'municipio_id' => $municipality['minicipio_id']
                    ]);
                };
            });
        });
    }

    protected function insertSector($file){
        SectorTemp::truncate();
        $content        = Storage::disk('local')->get($file);
        $json           = json_decode($content, true);
        $municipalities = Municipality::all();
        if(!Sector::count() && !SectorTemp::count())
        {
            SectorTemp::insert($json);
        }
        collect($municipalities)->map(function($municipality){
            $sectorArrayTmp = $municipality->sectorTemp;
            Sector::insert($sectorArrayTmp->map(function($sector) use ($municipality){
                return [
                    'name' => $sector->sector,
                    'municipio_id' => $municipality->id,
                ];
            })->toArray());
        });
        SectorTemp::truncate();
    }
}
