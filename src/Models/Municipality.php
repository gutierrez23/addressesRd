<?php

namespace FgutierrezPHP\AddresesRd\Models;

use FgutierrezPHP\AddresesRd\Http\Filters\MunicipalityFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Municipality extends Model
{
    use LogsActivity;
    
    protected $guarded = ['id'];
    protected $table;
    
    public function __construct()
    {
        parent::__construct();

        $this->table = config('addreses_rd.tables_prefix').'municipalities';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*'])
        ->dontSubmitEmptyLogs()
        ->useLogName('municipality')
        ->setDescriptionForEvent(fn(string $eventName) => "activity.logs.municipality.{$eventName}")
        ->dontLogIfAttributesChangedOnly(['updated_at']);
    }

    public function scopeFilter(Builder $query, MunicipalityFilter $filter): Builder
    {
        return $filter->apply($query);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    
    public function sector(){
        return $this->hasMany(Sector::class, 'municipio_id', 'id');
    }

    public function sectorTemp(){
        return $this->hasMany(SectorTemp::class, 'municipio_id', 'municipio_id');
    }

    public function agencies()
    {
        return $this->hasMany(Banca::class, 'municipio_id');
    }
}
