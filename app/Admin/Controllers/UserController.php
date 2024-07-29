<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('nickname');
            $grid->column('avatar')->image('',50);
            $grid->column('phone');
            $grid->column('sex');
            $grid->column('birthday');
            $grid->column('school');
            $grid->column('occupation');
            $grid->column('real_name');
            $grid->column('id_card');
            $grid->column('is_real_name');
            $grid->column('fans_count');
            $grid->column('follow_count');
//            $grid->column('openid');
//            $grid->column('session_key');
//            $grid->column('api_token');
//            $grid->column('status');
//            $grid->column('my_invite_code');
//            $grid->column('invite_code');
//            $grid->column('invite_user_id');
            $grid->column('invite_count');
            $grid->column('price');
            $grid->column('is_vip')->using([0=>'否',1=>'是']);
            $grid->column('vip_end_time');
            $grid->column('province_id')->distpicker();
            $grid->column('city_id')->distpicker();
            $grid->column('district_id')->distpicker();
            $grid->column('activity_num');
            $grid->column('search_num');
            $grid->column('last_day');
            $grid->column('images')->image('',50);
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('nickname');
                $filter->equal('phone');

            });
            $grid->disableCreateButton();
            $grid->disableBatchDelete();
            $grid->disableDeleteButton();
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
        return Show::make($id, new User(), function (Show $show) {
            $show->field('id');
            $show->field('nickname');
            $show->field('avatar')->image();
            $show->field('phone');
            $show->field('sex')->using([0=>'未知',1=>'男',2=>'女']);
            $show->field('birthday');
            $show->field('school');
            $show->field('occupation');
            $show->field('real_name');
            $show->field('id_card');
            $show->field('is_real_name');
            $show->field('fans_count');
            $show->field('follow_count');
//            $show->field('openid');
//            $show->field('session_key');
//            $show->field('api_token');
//            $show->field('status');
//            $show->field('my_invite_code');
//            $show->field('invite_code');
//            $show->field('invite_user_id');
            $show->field('invite_count');
            $show->field('price');
            $show->field('is_vip')->using([0=>'否',1=>'是']);
            $show->field('vip_end_time');
            $show->field('province_id');
            $show->field('city_id');
            $show->field('district_id');
            $show->field('activity_num');
            $show->field('search_num');
            $show->field('last_day');
            $show->field('images');
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
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            $form->text('nickname');
            $form->text('avatar');
            $form->text('phone');
            $form->text('sex');
            $form->text('birthday');
            $form->text('school');
            $form->text('occupation');
            $form->text('real_name');
            $form->text('id_card');
            $form->text('is_real_name');
            $form->text('fans_count');
            $form->text('follow_count');
            $form->text('openid');
            $form->text('session_key');
            $form->text('api_token');
            $form->text('status');
            $form->text('my_invite_code');
            $form->text('invite_code');
            $form->text('invite_user_id');
            $form->text('invite_count');
            $form->text('price');
            $form->text('is_vip');
            $form->text('vip_end_time');
            $form->text('province_id');
            $form->text('city_id');
            $form->text('district_id');
            $form->text('activity_num');
            $form->text('search_num');
            $form->text('last_day');
            $form->text('images');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
