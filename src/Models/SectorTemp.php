<?php

namespace FgutierrezPHP\AddresesRd\Models;

use Illuminate\Database\Eloquent\Model;

class SectorTemp extends Model
{
    protected $guarded = ['id'];
    protected $table;
    
    public function __construct()
    {
        parent::__construct();

        $this->table = config('addreses_rd.tables_prefix').'sector_temps';
    }
}
