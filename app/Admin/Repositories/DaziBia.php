<?php

namespace App\Admin\Repositories;

use App\Models\DaziBias as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class DaziBia extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
