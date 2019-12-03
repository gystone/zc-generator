<?php

namespace Tjzen\Generator\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Tjzen\Generator\Generators\FileGenerator;

abstract class GeneratorCommand extends Command
{
    /**
     * 参数名称
     * @var string
     */
    protected $argumentName = '';

    /**
     * 获取模板内容
     * @return string
     */
    abstract protected function getTemplateContents();

    /**
     * 获取目标文件路径
     * @return string
     */
    abstract protected function getDestinationFilePath();

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //转换文件路径格式
        $path = str_replace('\\', '/', $this->getDestinationFilePath());
        //dirname() 保留路径
        if (!$this->laravel['files']->isDirectory($dir = dirname($path))) {
            //目标文件夹不存在，则创建文件夹
            $this->laravel['files']->makeDirectory($dir, 0777, true);
        }

        //获取模板内容
        $contents = $this->getTemplateContents();

        try {
            //是否覆盖文件 -- 目前无用，没有传值
            $overwriteFile = $this->hasOption('force') ? $this->option('force') : false;
            //生成文件
            (new FileGenerator($path, $contents))->withFileOverwrite($overwriteFile)->generate();



        } catch (\Exception $e) {
            $this->error("ERR:{$path} 文件已存在");
        }

    }

    /**
     * 获取文件名称
     * @return string
     */
    public function getClass()
    {
        return class_basename($this->argument($this->argumentName));
    }

    /**
     * 获取默认命名空间
     * @return string
     */
    abstract protected function getDefaultNamespace();


    /**
     * 获得class 的命名空间
     * @param $module
     * @return string
     */
    public function getClassNamespace()
    {
        $namespace = '';
        // Abcc   '' AA/Abcc
//        $extra = str_replace($this->getClass(), '', );

        $extra = str_replace('/', '\\', $this->argument($this->argumentName));//AA\

        if ($this->option('file')) {
            //如果生成为文件，则删除模块命名空间
            $extra = Str::replaceLast('\\'.$this->getClass(),'',$extra);
        }
        $namespace .= '\\' . $this->getDefaultNamespace();

        $namespace .= '\\' . $extra;
        $namespace = str_replace('/', '\\', $namespace);

        return trim($namespace, '\\');

    }


}
