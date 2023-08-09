<?php

namespace View;

use Exception;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\Filesystem\Filesystem;

class View{

    private static $viewFactory;
    
    public static function render($viewName, $data = []) {
        $viewPath = 'tpl/' . $viewName . '.php';
        if (file_exists($viewPath)) {

            extract($data);
            ob_start();

            include $viewPath;
            $viewContent = ob_get_clean();

            return $viewContent;

        } else {
            throw new Exception("View file '{$viewName}.php' not found.");
        }
    }

    public static function renderBlade($view, $data = [])
    {
        if (!isset(self::$viewFactory)) {
            $viewPaths = ['tpl'];
            $fileSystem = new Filesystem;
            $viewFinder = new FileViewFinder($fileSystem, $viewPaths);
            $bladeCompiler = new BladeCompiler($fileSystem, projectPath() . 'tpl/cache');
            $resolver = new EngineResolver;
            $resolver->register('blade', function () use ($bladeCompiler) {
                return new CompilerEngine($bladeCompiler);
            });
            self::$viewFactory = new Factory($resolver, $viewFinder, new \Illuminate\Events\Dispatcher);
        }

        echo self::$viewFactory->make($view, $data)->render();
    }
}