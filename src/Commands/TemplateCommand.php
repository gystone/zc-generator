<?php

namespace Tjzen\Generator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;


class TemplateCommand extends Command
{

    protected $signature = 'make:temp {name}';

    protected $description = 'create temllate';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
//        $this->call('zc:controller', [
//            'name' => $this->argument('name'),
//        ]);

//        $this->call('zc:model', [
//            'name' => $this->argument('name'),
//        ]);


        $this->call('make:migration', [
            'name' => "create_{$this->databaseName()}_table"
        ]);
    }


    public function databaseName()
    {
        $base_name = class_basename($this->argument('name'));
        $sn = Str::snake($base_name);
        return Str::plural($sn);

    }


}
