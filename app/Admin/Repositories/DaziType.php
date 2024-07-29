<?php

namespace App\Admin\Repositories;

use App\Models\DaziType as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class DaziType extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
