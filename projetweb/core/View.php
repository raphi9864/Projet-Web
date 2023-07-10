<?php

class View
{
    public function render($viewFile, $data = [])
    {
        extract($data);

        ob_start();
        include_once "app/views/" . $viewFile . ".php";
        $content = ob_get_clean();

        include_once "app/views/layout.php";
    }
} 