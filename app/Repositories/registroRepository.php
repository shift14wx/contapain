<?php

namespace App\Repositories;

use App\Models\Registro;
use App\Repositories\BaseRepository;

/**
 * Class registroRepository
 * @package App\Repositories
 * @version October 1, 2020, 5:17 am UTC
*/

class registroRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_detalle_concepto',
        'debe',
        'haber',
        'concepto_detallado',
        'id_rubro',
        'id_asiento'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return registro::class;
    }
}
