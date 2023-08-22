<?php
namespace FgutierrezPHP\AddresesRd\Database\Seeders;

use FgutierrezPHP\AddresesRd\Models\Municipality;
use FgutierrezPHP\AddresesRd\Models\Province;
use FgutierrezPHP\AddresesRd\Models\Sector;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\File;

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
            $file = dirname(dirname(dirname(__DIR__))).'/resources/files/territorial_division.json';
            $this->insertProvinces($file);
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
    }

    protected function insertProvinces($file){
        $content    = File::get($file);
        $json       = json_decode($content, true);

        collect($json['data'])->map(function($value) { 
            $province = Province::create(['name' => $value['name']]);
            $this->insertMunicipalities($province->id, $value['municipalities']);
        });
    }

    protected function insertMunicipalities($province, $municipalities){     
        collect($municipalities)->map(function($value) use ($province) {
            $municipality = Municipality::create([
                'province_id' => $province,
                'name' => $value['name']
            ]);
            $this->insertSector($municipality->id, $value['sectors']);
        });
    }

    protected function insertSector($municipality, $sectors){
        collect($sectors)->map(function($sector) use ($municipality){
            Sector::create([
                'municipality_id' => $municipality,
                'name' => $sector['name']
            ]);
        });
    }
}
