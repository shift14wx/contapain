<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cartoon
 * @package App\Models
 * @version September 30, 2020, 1:17 am UTC
 *
 * @property string $name
 * @property boolean $avalible
 */
class Cartoon extends Model
{
    use SoftDeletes;

    public $table = 'cartoons';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'avalible'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'avalible' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'name' => 'nullable|string|max:255',
        'avalible' => 'required|boolean'
    ];

    
}
