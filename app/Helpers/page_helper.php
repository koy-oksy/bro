<?php

if (! function_exists('show_param')) {
    function show_param($name, $value) {
        if (!$value) {
            return '';
        }
        return "<p><strong>$name</strong>: $value</p>";
    }
}

if (! function_exists('replace_image_url')) {
    function replace_image_url($url) {
        if (!$url) {
            return '';
        }
        return site_url('image/' . $url);
    }
}