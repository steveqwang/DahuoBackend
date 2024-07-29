<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Setting;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SettingController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Setting(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('type')->using(\App\Models\Setting::$type_maps);
            $grid->column('alias');
//            $grid->column('value');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('title');

            });
            $grid->actions(function ($actions) {
//            $actions->disableView();
//                $actions->disableEdit();
                $actions->disableDelete();
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
        return Show::make($id, new Setting(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('type')->using(\App\Models\Setting::$type_maps);
            $show->field('alias');
            $show->field('value')->unescape();
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
        return Form::make(new Setting(), function (Form $form) {
            if($form->isCreating()){

                $form->text('title', __('名称'));
                $form->text('alias', __('标识'));
                $form->select('type', __('类型'))->options(\App\Models\Setting::$type_maps)
                    ->when('=', \App\Models\Setting::TYPE_STRING, function (Form $form) {
                        $form->text('value1', '值');
                    })->when('=', \App\Models\Setting::TYPE_IMG, function (Form $form) {
                        $form->image('value2', '值')->uniqueName();
                    })->when('=', \App\Models\Setting::TYPE_TEXT, function (Form $form) {
                        $form->editor('value3', '值');
                    })->when('=', \App\Models\Setting::TYPE_NUM, function (Form $form) {
                        $form->number('value4', '值');
                    })->when('=', \App\Models\Setting::TYPE_VIDEO, function (Form $form) {
                        $form->file('value5', '值');
                    });

                $form->hidden('value');



            }else{
                $form->text('title', __('名称'))->readonly();
                $form->text('alias', __('标识'))->readonly();
                $parameters = \request()->route()->parameters();
                $id = null;
                foreach ($parameters as $alias) {
                    $id = $alias;
                    break;
                }
                $setting = \App\Models\Setting::find($id);
                if($setting->type==\App\Models\Setting::TYPE_STRING){
                    $form->text('value', '值');
                }elseif ($setting->type==\App\Models\Setting::TYPE_IMG){
                    $form->image('value', '值')->uniqueName();
                }elseif ($setting->type==\App\Models\Setting::TYPE_TEXT){
                    $form->editor('value', '值');
                }elseif ($setting->type==\App\Models\Setting::TYPE_NUM){
                    $form->number('value', '值');
                }elseif ($setting->type==\App\Models\Setting::TYPE_VIDEO){
                    $form->file('value', '值');
                }
            }
        });
    }
}
