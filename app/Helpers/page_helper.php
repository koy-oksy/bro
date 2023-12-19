<?php

if (! function_exists('show_param')) {
    function show_param($name, $value) {
        if (!$value) {
            return '';
        }
        return "<p><b>$name</b>: $value</p>";
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

if (! function_exists('drop_image_into_browser')) {
    function drop_image_into_browser($path) {
        if (!$path) {
            return '';
        }
        $image = fopen($path, 'rb');
        header("Content-Type: image/webp");
        header("Content-Length: " . filesize($path));
        fpassthru($image);
    }
}

if (! function_exists('log_action')) {
    function log_action($alias, $type) {
        $data = $_SERVER['HTTP_USER_AGENT'] . "<br>" . $_SERVER['REMOTE_ADDR'];
        $user_data = print_r($data, 1);
        $data = [
            'alias' => $alias,
            'user_data' => $user_data,
            'type' => $type,
        ];
        $logModel = new \App\Models\LogModel();
        $logModel->insert($data);
    }
}

if (! function_exists('get_page_by_alias_type')) {
    function get_page_by_alias_type($alias, $type) {
        if ($type === 'static') {
            $pageModel = new \App\Models\StaticpageModel();
            $page_data = $pageModel->where('alias', $alias)->first();
            $data = [
                'title' => $page_data['title'],
                'type' => 'Сторінка',
                'url' => '',
                'edit_url' => '',
                'today_count' => 1,
                'week_count' => 10,
                'all_count' => 100,
            ];
        } else {
            $pageModel = new \App\Models\HikeModel();
            $page_data = $pageModel->where(['alias' => $alias, 'hike_type' => $type])->first();
            $data = [
                'title' => $page_data['caption'],
                'type' => $type === 'carpatian' ? 'Карпати' : 'Закордон',
                'url' => '',
                'edit_url' => '',
                'today_count' => 1,
                'week_count' => 10,
                'all_count' => 100,
            ];
        }
        return $data;
    }
}