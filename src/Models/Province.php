<?php

namespace FgutierrezPHP\AddresesRd\Models;

use App\Http\Filters\ProvinceFilter;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Province extends Model
{
    use LogsActivity;

    protected $guarded = ['id'];
    protected $table;
    
    public function __construct()
    {
        parent::__construct();

        $this->table = config('addreses_rd.tables_prefix').'provinces';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*'])
        ->dontSubmitEmptyLogs()
        ->useLogName('province')
        ->setDescriptionForEvent(fn(string $eventName) => "activity.logs.province.{$eventName}")
        ->dontLogIfAttributesChangedOnly(['updated_at']);
    }

    public function scopeFilter(Builder $builder, ProvinceFilter $filter)
    {
        return $filter->apply($builder);
    } 
    
    public function municipality()
    {
        return $this->hasMany(Municipality::class);
    }

    public function agencies()
    {
        return $this->hasMany(Banca::class, 'provincia_id');
    }
}
