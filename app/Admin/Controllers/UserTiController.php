<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\TxJj;
use App\Admin\Actions\Grid\TxTy;
use App\Admin\Repositories\UserTi;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UserTiController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new UserTi(['user']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('user.nickname');
            $grid->column('price');
            $grid->column('status')->using([1=>'未处理',2=>'已处理',3=>'已拒绝']);
            $grid->column('remark');
            $grid->column('ti_time');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('user.phone');
                $filter->equal('user.nickname');

            });

            $grid->disableCreateButton();
            $grid->disableBatchDelete();
            $grid->disableDeleteButton();
            $grid->disableEditButton();
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if($actions->row->status==1){
                    $actions->append(new TxTy());
                    $actions->append(new TxJj());
                }

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
        return Show::make($id, new UserTi(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('price');
            $show->field('status');
            $show->field('remark');
            $show->field('ti_time');
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
        return Form::make(new UserTi(), function (Form $form) {
            $form->display('id');
            $form->text('user_id');
            $form->text('price');
            $form->text('status');
            $form->text('remark');
            $form->text('ti_time');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
