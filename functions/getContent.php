<?php
function getContent($Path)
{
    ob_start();
    require (PATH . 'Templates/' . $Path . '.php');
    echo ob_get_clean();
}