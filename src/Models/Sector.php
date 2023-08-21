<?php

namespace FgutierrezPHP\AddresesRd\Models;

use FgutierrezPHP\AddresesRd\Http\Filters\SectorFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Sector extends Model
{
    use LogsActivity; 
    
    protected $guarded = ['id'];
    protected $table;
    
    public function __construct()
    {
        parent::__construct();

        $this->table = config('addreses_rd.tables_prefix').'sectors';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*'])
        ->dontSubmitEmptyLogs()
        ->useLogName('sector')
        ->setDescriptionForEvent(fn(string $eventName) => "activity.logs.sector.{$eventName}")
        ->dontLogIfAttributesChangedOnly(['updated_at']);
    }

    public function scopeFilter(Builder $query, SectorFilter $filter): Builder
    {
        return $filter->apply($query);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    } 

    public function agencies()
    {
        return $this->hasMany(Banca::class, 'sector_id');
    }
}
