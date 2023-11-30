<?php

if (! function_exists('parse_bro_url')) {
    function parse_bro_url($url = ''): array
    {
        $parsed_data = [
            'title' => '',
            'description' => '',
            'image' => '',
            'text' => '',
        ];
        
        $content = file_get_contents($url);
        
        if (!$content) {
            return $parsed_data;
        }
        
        // meta parse
        preg_match_all('/<meta property="og:(.+?)" content="((.|\n)*?)">/', $content, $output_array);
        if ($output_array) {
            foreach ($output_array[1] as $key => $property_name) {
                if (in_array($property_name, ['title', 'description', 'image'])) {
                    $parsed_data[$property_name] = $output_array[2][$key];
                }
            }
        }
        
        if (strpos($content, 'tl_article_content')) {
            $dom = new DOMDocument();
            @$dom->loadHTML($content);
            $xpath = new DOMXPath($dom);
            $article = $xpath->query('//article[@class="tl_article_content"]');
            $article = $article->item(0);
            $article_content = $dom->saveXML($article);
            $article_content = str_replace(['<article id="_tl_editor" class="tl_article_content">', '</article>'], '', $article_content);
            $parsed_data['text'] = $article_content;
        }
        
        if (empty($parsed_data['image']) && $parsed_data['text']) {
            // get first image from content
            $dom = new DOMDocument();
            @$dom->loadHTML($parsed_data['text']);
            $xpath = new DOMXPath($dom);
            $figure = $xpath->query('//figure');
            $figure = $figure->item(0);
            $figure_content = $dom->saveXML($figure);
            $figure_content = str_replace(['<figure>', '</figure>'], '', $figure_content);
            preg_match('/src="(.*)"/', $figure_content, $output_array);
            if ($output_array) {
                $src = "https://telegra.ph" . $output_array[1];
                $parsed_data['image'] = $src;
            }
        }
        
        if ($parsed_data['text']) {
            // try to get other hike data
            $parsed_content = parse_hike_content($parsed_data['text']);
            var_dump($parsed_content); die;
        }
        
        return $parsed_data;
    }

}

if (! function_exists('parse_hike_content')) {
    function parse_hike_content($content = ''): array
    {
        $found_params = [
            'download_src' => [],
            'days' => '', 
            'date' => '', 
            'dates' => '', 
            'format' => '', 
            'price' => '', 
            'participants' => '',
            'distance' => '',
            'route' => '',
        ];
        
        // get image links
        preg_match_all('/src="(.*?)"\/>/', $content, $output_array);
        if ($output_array) {
            $found_params['download_src'] = $output_array[1];
        }
        
        //get other data
        $param_name = [
            'days' => 'Тривалість:', 
            'date' => 'Дата:', 
            'dates' => 'Дати:', 
            'format' => 'Формат:', 
            'price' => 'Вартість:', 
            'participants' => 'Кількість місць:',
            'distance' => 'Протяжність:',
            'route' => 'Маршрут:',
        ];
        $param_name_f = implode('|', $param_name);
        preg_match_all("/<p>(<strong>)*($param_name_f)(\s)*(<\/strong>)*(.*?)<\/p>/", $content, $output_array);
        if ($output_array) {
            foreach ($output_array[2] as $key => $name) {
                $f_params = array_flip($param_name);
                if (isset($f_params[trim($name)])) {
                    $found_params[$f_params[trim($name)]] = trim($output_array[5][$key]);
                }
            } 
        }
        
        return $found_params;
    }
}