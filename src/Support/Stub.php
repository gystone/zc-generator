<?php

namespace Tjzen\Generator\Support;

class Stub
{

    /**
     * 文件路径
     * @var
     */
    protected $path;

    /**
     * 文件基本路径
     * @var null
     */
    protected static $basePath = null;

    /**
     * 替换的内容
     * @var array
     */
    protected $replaces = [];


    public function __construct($path, array $replaces = [])
    {
        $this->path = $path;
        $this->replaces = $replaces;
    }

    /**
     * 创建一个自身实例
     * @param $path
     * @param array $replaces
     * @return Stub
     */
    public static function create($path, array $replaces = [])
    {
        return new static($path, $replaces);
    }


    /**
     * 获取基本路径
     * @return null
     */
    public static function getBasePath()
    {
        return static::$basePath;
    }

    /**
     * 获取完整路径
     * @return mixed
     */
    public function getPath()
    {
        $path = static::getBasePath() . $this->path;

        return file_exists($path) ? $path : __DIR__ . '/../Commands/stubs' . $this->path;
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
     * 设置基本路径
     * @param $path
     */
    public static function setBasePath($path)
    {
        static::$basePath = $path;
    }


    /**
     * 获取替换后文本内容
     * @return bool|mixed|string
     */
    public function getContents()
    {
        //获取模板内容
        $contents = file_get_contents($this->getPath());

        //替换关键词
        foreach ($this->replaces as $search => $replace) {
            $contents = str_replace('$' . strtoupper($search) . '$', $replace, $contents);
        }

        return $contents;
    }


    /**
     * 执行 获取文本
     * @return bool|mixed|string
     */
    public function render()
    {
        return $this->getContents();
    }


    /**
     * 将内容保存到指定目录
     * @param $path
     * @param $filename
     * @return bool|int
     */
    public function saveTo($path, $filename)
    {
        return file_put_contents($path . '/' . $filename, $this->getContents());
    }


    /**
     * 设置替换数组
     * @param array $replaces
     * @return $this
     */
    public function replace(array $replaces = [])
    {
        $this->replaces = $replaces;

        return $this;
    }

    public function getReplaces()
    {
        return $this->replaces;
    }

    /**
     * 处理魔术方法
     * @return bool|mixed|string
     */
    public function __toString()
    {
        return $this->render();
    }


}
