<?php

namespace Tjzen\Generator\Generators;

use Illuminate\Filesystem\Filesystem;

class FileGenerator extends Generator
{

    protected $path;

    protected $contents;

    /**
     *  laravel 文件驱动 或 null
     * @var Filesystem | null
     */
    protected $filesystem;

    /**
     * @var bool
     */
    private $overwriteFile;

    /**
     * FileGenerator constructor.
     * @param $path
     * @param $contents
     * @param null $filesystem
     */
    public function __construct($path, $contents, $filesystem = null)
    {
        $this->path = $path;
        $this->contents = $contents;
        $this->filesystem = $filesystem ?: new Filesystem();
    }


    public function getContents()
    {
        return $this->contents;
    }


    public function setContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * @return Filesystem|null
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * @param Filesystem|null $filesystem
     */
    public function setFilesystem(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }


    /**
     * 带文件覆盖
     * @param bool $overwrite
     * @return FileGenerator
     */
    public function withFileOverwrite(bool $overwrite): FileGenerator
    {
        $this->overwriteFile = $overwrite;

        return $this;
    }

    /**
     * 生成文件
     * @return bool|int
     * @throws \Exception
     */
    public function generate()
    {
        $path = $this->getPath();
        //如果文件不存在，直接按path生成
        if (!$this->filesystem->exists($path)) {
            return $this->filesystem->put($path, $this->getContents());
        }

        //如果覆盖开启 直接覆盖
        if ($this->overwriteFile === true) {
            return $this->filesystem->put($path, $this->getContents());
        }

        //否则直接抛出异常
        throw new \Exception('目标文件存在');

    }


}
