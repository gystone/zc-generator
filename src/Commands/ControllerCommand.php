<?php

namespace Zen\Generator\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Zen\Generator\Support\Stub;

class ControllerCommand extends GeneratorCommand
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
    protected $name = 'zc:controller';


    protected $description = 'Create a new controller';


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
        return (new Stub('/controller.stub', [
            'CLASS_NAMESPACE' => $this->getClassNamespace(),
            'CLASS' => $this->getClassName(),
            'MODULE' => strtolower($this->getClass()),
        ]))->render();
    }

    protected function getDefaultNamespace()
    {
        return 'App\Http\Controllers';
    }


    protected function getDestinationFilePath()
    {
        $path = app_path('Http/Controllers/');

        if ($this->option('file')) {
            return $path . $this->getFilePath() . 'Controller.php';
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
        return class_basename($this->argument($this->argumentName)) . 'Controller.php';
    }

    public function getClassName()
    {
        return $this->getClass() . 'Controller';
    }


}
