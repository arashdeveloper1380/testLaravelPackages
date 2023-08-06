<?php

namespace View;

use Exception;

class View{

    public static function loadView($viewName, $data = []) {
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
}