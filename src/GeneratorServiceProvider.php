<?php
/**
 * Author: ZhaoZhen <270281156@qq.com>
 * Date: 2019/11/27 上午9:31
 */

namespace Zen\Generator;

use Illuminate\Support\ServiceProvider;
use Zen\Generator\Commands\ControllerCommand;
use Zen\Generator\Commands\ModelCommand;
use Zen\Generator\Commands\TemplateCommand;

class GeneratorServiceProvider extends ServiceProvider
{
//    protected $defer = true;

    protected $commands = [
        TemplateCommand::class,
        ControllerCommand::class,
        ModelCommand::class,
    ];

    public function register()
    {
        $this->commands($this->commands);
    }


}
