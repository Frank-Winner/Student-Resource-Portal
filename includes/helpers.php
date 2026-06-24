<?php

function isActive($page)
{
    $current =
        basename($_SERVER['PHP_SELF']);

    return $current === $page ? 'active' : '';
}
