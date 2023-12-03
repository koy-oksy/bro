<?php

if (! function_exists('show_param')) {
    function show_param($name, $value) {
        if (!$value) {
            return '';
        }
        return "<p><strong>$name</strong>: $value</p>";
    }
}