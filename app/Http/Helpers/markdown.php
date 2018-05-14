<?php
use GrahamCampbell\Markdown\Facades\Markdown;

/**
 * @param $str
 * @return mixed
 */
function markdown($str)
{
    return Markdown::convertToHtml($str);
}