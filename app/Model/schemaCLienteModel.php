<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class schemaCLienteModel extends Model
{
    protected $table="INFORMATION_SCHEMA.COLUMNS";
    protected $fillable=["COLUMN_NAME","TABLE_NAME","TABLE_SCHEMA"];
    

    public function scopeColumn($query,$v)
    {
        return $query->where('COLUMN_NAME','like',"%".$v."%");
    }

    public function scopeTable($query,$v)
    {
        return $query->where('TABLE_NAME',$v);
    }

    public function scopeBd($query)
    {
        return $query->where('TABLE_SCHEMA',env('DB_DATABASE'));
    }


}
