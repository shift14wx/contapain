<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class registro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table="registro";
    protected $primaryKey = 'id_registro';

    public function Asiento()
    {
        return $this->belongsTo(Asiento::class, 'id_asiento');
    }

}
