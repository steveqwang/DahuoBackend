<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\ActivityJj;
use App\Admin\Actions\Grid\ActivityTy;
use App\Admin\Repositories\Activity;
use App\Models\ActivityType;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ActivityController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Activity(['user','activityType']), function (Grid $grid) {
            $grid->model()->orderByDesc('id');
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('activityType.title');
            $grid->column('image')->image('',50);
//            $grid->column('images');
            $grid->column('user.nickname');
            $grid->column('status')->using([1=>'审核中',2=>'未开始',3=>'进行中','4'=>'已结束','5'=>'审核失败','6'=>'已取消']);
            $grid->column('activity_date');
            $grid->column('start_time');
            $grid->column('end_time');
            $grid->column('sign_up_end_time');
            $grid->column('activity_number');
            $grid->column('sign_up_number');
            $grid->column('address');
//            $grid->column('content');
            $grid->column('longitude');
            $grid->column('latitude');
            $grid->column('read_number');
            $grid->column('price');
            $grid->column('is_open')->using([0 => '否', 1 => '是']);
            $grid->column('is_prohibit')->using([0 => '否', 1 => '是']);
//            $grid->column('nan_num');
//            $grid->column('nv_num');
            $grid->column('type')->using([1 => '免费', 2 => '线下', 3 => '线上', 4 => '线上收费']);
            $grid->column('underlined_price');
            $grid->column('province');
            $grid->column('city');
            $grid->column('district');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('title');

            });
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if($actions->row->status==1){
                    $actions->append(new ActivityTy());
                    $actions->append(new ActivityJj());
                }

            });
            $grid->disableBatchDelete();
            $grid->disableDeleteButton();
            $grid->disableCreateButton();
            $grid->disableEditButton();
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
        return Show::make($id, new Activity(['user','activityType']), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('activity_type_id')->as(function ($activity_type_id){
                return ActivityType::where('id',$activity_type_id)->value('title');
            });
            $show->field('image')->image();
            $show->field('images')->image();
            $show->field('user.nickname');
            $show->field('status')->using([1=>'审核中',2=>'未开始',3=>'进行中','4'=>'已结束','5'=>'审核失败','6'=>'已取消']);
            $show->field('activity_date');
            $show->field('start_time');
            $show->field('end_time');
            $show->field('sign_up_end_time');
            $show->field('activity_number');
            $show->field('sign_up_number');
            $show->field('address');
            $show->field('content');
            $show->field('longitude');
            $show->field('latitude');
            $show->field('read_number');
            $show->field('price');
            $show->field('is_open')->using([0 => '否', 1 => '是']);
            $show->field('is_prohibit')->using([0 => '否', 1 => '是']);
//            $show->field('nan_num');
//            $show->field('nv_num');
            $show->field('type')->using([1 => '免费', 2 => '线下', 3 => '线上', 4 => '线上收费']);
            $show->field('underlined_price');
            $show->field('province');
            $show->field('city');
            $show->field('district');
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
        return Form::make(new Activity(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('activity_type_id');
            $form->text('image');
            $form->text('images');
            $form->text('user_id');
            $form->text('status');
            $form->text('activity_date');
            $form->text('start_time');
            $form->text('end_time');
            $form->text('sign_up_end_time');
            $form->text('activity_number');
            $form->text('sign_up_number');
            $form->text('address');
            $form->text('content');
            $form->text('longitude');
            $form->text('latitude');
            $form->text('read_number');
            $form->text('price');
            $form->text('is_open');
            $form->text('is_prohibit');
            $form->text('nan_num');
            $form->text('nv_num');
            $form->text('type');
            $form->text('underlined_price');
            $form->text('province_id');
            $form->text('city_id');
            $form->text('district_id');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
