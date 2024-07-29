<?php

namespace App\Admin\Repositories;

use App\Models\UserTi as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class UserTi extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
