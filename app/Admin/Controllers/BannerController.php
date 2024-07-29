<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Banner;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class BannerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Banner(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('img')->image('',50);
            $grid->column('sort');
            $grid->column('status')->switch();

            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
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
        return Show::make($id, new Banner(), function (Show $show) {
            $show->field('id');
            $show->field('img')->image();
            $show->field('sort');
            $show->field('status')->using([1 => '启用', 0 => '禁用']);
            $show->field('title');
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
        return Form::make(new Banner(), function (Form $form) {
            $form->display('id');
            $form->text('title')->required();
            $form->image('img');
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
