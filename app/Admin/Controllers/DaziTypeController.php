<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\DaziType;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class DaziTypeController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new DaziType(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('status')->using([1 => '启用', 0 => '禁用']);
            $grid->column('sort');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('title');

            });
            $grid->disableDeleteButton();
            $grid->disableBatchDelete();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new DaziType(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('status')->using([1 => '启用', 0 => '禁用']);
            $show->field('sort');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new DaziType(), function (Form $form) {
            $form->display('id');
            $form->text('title')->required();
            $form->number('sort')->required()->default(0);
            $form->switch('status')->customFormat(function ($v) {
                return $v == '1' ? 1 : 2;
            })
                ->saving(function ($v) {
                    return $v ? '1' : '2';
                })->default(1);
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
