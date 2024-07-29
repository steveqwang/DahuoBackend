<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MakeModel extends Command
{
    protected $signature = "make:model {table} {--m|model= : 模型名} {--s|namespace=App\\Model : 命名空间} {--f|force} {--dry}";

    protected $description = "代码生成器-Model 用法: make:model 表名 [--s|namespace=命名空间]";

    public function handle()
    {
        $tableName = $this->argument('table');
        $className = $this->option('model') ? $this->option('model') : str_replace('_', '', ucwords($tableName, '_'));
        $namespace = $this->option('namespace') ? $this->option('namespace') : 'App\Model';
        $relPath = lcfirst(str_replace('\\', '/', $namespace));
        $path = base_path($relPath . '/' . $className . '.php');

        $columns = $this->getColumns($tableName);
        unset($columns['LogicalDel']);
        $view = view('console.model', compact('tableName', 'namespace', 'columns', 'className'));

        if ($this->option('dry')) {
            echo $view->render();
            exit(0);
        }

        if (file_exists($path) && !$this->option('force')) {
            echo "文件已存在，使用-f参数可强制覆盖\n";
            exit(1);
        }

        file_put_contents($path, $view->render());
        exit(0);
    }

    protected function getColumns($table)
    {
        $table = addslashes($table);
        $metas = DB::select(DB::raw("SHOW COLUMNS FROM `{$table}`"));
        $columns = [];
        foreach ($metas as $meta) {
            $columns[$meta->Field] = $this->getColumnType($meta->Type);
        }

        return $columns;
    }

    protected function getColumnType($metaType)
    {
        $maps = [
            'timestamp' => 'datetime',
            'tinyint' => 'integer',
            'smallint' => 'integer',
            'mediumint' => 'integer',
            'int' => 'integer',
            'bigint' => 'integer',
            'decimal' => 'float',
        ];

        $pos = strpos($metaType, ' ');
        if ($pos === false) {
            $pos = strpos($metaType, '(');
        }
        if ($pos !== false) {
            $metaType = substr($metaType, 0, $pos);
        }

        return array_key_exists($metaType, $maps) ? $maps[$metaType] : 'string';
    }
}

