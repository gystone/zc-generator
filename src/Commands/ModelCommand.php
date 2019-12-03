<?php

namespace Tjzen\Generator\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Tjzen\Generator\Support\Stub;

class ModelCommand extends GeneratorCommand
{
    /**
     * 参数名称
     * @var string
     */
    protected $argumentName = 'name';


    /**
     * 命令名称
     * @var string
     */
    protected $name = 'zc:model';


    protected $description = 'Create a new model';


    /**
     * 获取控制台命令参数
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the factory'],

        ];
    }

    protected function getOptions()
    {
        return [
            ['file']
        ];
    }


    protected function getTemplateContents()
    {
//        dd($this->options(), $this->arguments());

        //获取命名空间
        return (new Stub('/model.stub', [
            'NAMESPACE' => $this->getClassNamespace(),
            'CLASS' => $this->getClassName(),
        ]))->render();
    }

    protected function getDefaultNamespace()
    {
        return 'App\Models';
    }


    protected function getDestinationFilePath()
    {
        $path = app_path('Models/');

        if ($this->option('file')) {
            return $path . $this->getFilePath() . '.php';
        } else {
            return $path . $this->getFilePath() . '/' . $this->getFileName();
        }

    }

    public function getFilePath()
    {
        return Str::studly($this->argument($this->argumentName));
    }

    public function getFileName()
    {
        return $this->getClass() . '.php';
    }

    public function getClassName()
    {
        return $this->getClass();
    }


}
