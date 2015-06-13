<?php

class View
{
    function render($file, $objects = null)
    {
        ob_start();
        include(__DIR__ . '/../views/header.php');
        include(__DIR__ . '/' . $file);
        include(__DIR__ . '/../views/footer.php');
        return ob_get_clean();

    }
}
