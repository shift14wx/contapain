<?php

namespace App\Repositories;

use App\Models\Cartoon;
use App\Repositories\BaseRepository;

/**
 * Class CartoonRepository
 * @package App\Repositories
 * @version September 30, 2020, 1:17 am UTC
*/

class CartoonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'avalible'
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
        return Cartoon::class;
    }
}
