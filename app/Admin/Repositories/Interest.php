<?php

namespace App\Admin\Repositories;

use App\Models\Interest as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Interest extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
