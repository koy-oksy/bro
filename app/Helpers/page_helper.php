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
    function log_action($url, $title, $type) {
        $data = $_SERVER['HTTP_USER_AGENT'] . "<br>" . $_SERVER['REMOTE_ADDR'];
        $user_data = print_r($data, 1);
        $data = [
            'url' => $url,
            'user_data' => $user_data,
            'type' => $type,
            'title' => $title,
        ];
        $logModel = new \App\Models\LogModel();
        $logModel->insert($data);
    }
}

if (! function_exists('get_page_url')) {
    function get_page_url($alias, $type) {
        switch ($type) {
            case 'carpatian':
                return '/carpatian-hikes/' . $alias;
            case 'foreign':
                return '/foreign-hikes/' . $alias;
            default: // static
                return '/page/' . $alias;
        } 
        
    }
}

if (! function_exists('get_url_view_count')) {
    function get_url_view_count($url, $period = false) {
        $db      = \Config\Database::connect();
        $builder = $db->table('log');   
        $builder->where('url', $url);
        switch ($period) {
            case 'month':
                $builder->where('created_at > (NOW() - INTERVAL 1 MONTH)');
                break;
            case 'week':
                $builder->where('created_at > (NOW() - INTERVAL 1 WEEK)');
                break;
            case 'day':
                $builder->where('created_at > (NOW() - INTERVAL 1 DAY)');
                break;
            default:
        }
        return $builder->countAllResults();        
    }
}