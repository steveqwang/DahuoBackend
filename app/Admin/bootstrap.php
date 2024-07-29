<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Show;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */


Form::resolving(function (Form $form) {

    $form->tools(function (Form\Tools $tools) {
        // 去掉`列表`按钮
        $tools->disableList();
        // 去掉`删除`按钮
        $tools->disableDelete();
        // 去掉`查看`按钮
        $tools->disableView();
    });
    $form->tools(function (Form\Tools $tools) {
        $tools->disableDelete();
        $tools->disableView();
        $tools->disableList();

    });
    $form->footer(function ($footer) {

        // 去掉`重置`按钮
        $footer->disableReset();



        // 去掉`查看`checkbox
        $footer->disableViewCheck();

        // 去掉`继续编辑`checkbox
        $footer->disableEditingCheck();

        // 去掉`继续创建`checkbox
        $footer->disableCreatingCheck();

    });
});
Grid::resolving(function (Grid $grid){

});

Show::resolving(function (Show $show){
    $show->panel()
        ->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableList();
            $tools->disableDelete();
        });;
});
