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
                if ($property_name === 'image') {
                    $parsed_data[$property_name] = str_replace("https://telegra.ph", "", trim($output_array[2][$key]));
                }
                if (in_array($property_name, ['title', 'description'])) {
                    $parsed_data[$property_name] = trim($output_array[2][$key]);
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
                $parsed_data['image'] = str_replace("https://telegra.ph", "", $output_array[1]);
            }
        }
        
        if ($parsed_data['text']) {
            // try to get other hike data
            $parsed_content = parse_hike_content($parsed_data['text']);
            $parsed_data = array_merge($parsed_data, $parsed_content);
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
            'total_price' => '',
            'participants' => '',
            'distance' => '',
            'route' => '',
            'difficulty' => '',
            'chapters' => [],
        ];
        
        if (!$content) {
            return $found_params;
        }
        
        // get image links
        preg_match_all('/src="(.*?)"\/>/', $content, $output_array);
        if ($output_array) {
            $found_params['download_src'] = $output_array[1];
        }
        
        //get params
        $param_name = [
            'days' => 'Тривалість:', 
            'date' => 'Дата:', 
            'dates' => 'Дати:', 
            'format' => 'Формат:', 
            'price' => 'Вартість:', 
            'total_price' => 'Загальний бюджет подорожі:',
            'participants' => 'Кількість учасників:',
            'distance' => 'Протяжність:',
            'route' => 'Маршрут:',
            'difficulty' => 'Складність:',
        ];
        $param_name_f = implode('|', $param_name);
        preg_match_all("/<p>(<strong>)*($param_name_f)(\s)*(<\/strong>)*(.*?)<\/p>/", $content, $output_array);
        if ($output_array) {
            foreach ($output_array[2] as $key => $name) {
                $f_params = array_flip($param_name);
                if (isset($f_params[trim($name)])) {
                    $found_params[$f_params[trim($name)]] = strip_tags(trim($output_array[5][$key]));
                    $content = str_replace($output_array[0][$key], '', $content);
                }
            } 
        }
        
        $chapters = [];
        $chapter = 0;
        // split content into liness
        preg_match_all('/(<p>|<ul>|<figure>|<blockquote>)(.*?)(<\/p>|<\/ul>|<\/figure>|<\/blockquote>)/', $content, $output_array);
        
        foreach($output_array[0] as $line) {
            preg_match('/<strong>(\s*)День\s\d(.*)<\/strong>/', $line, $found_day);
            if ($found_day || $line == '<hr>') {
                $chapter++;
                if ($line == '<hr>') {
                    continue; // skip line
                }
            }
            preg_match('/src="https:\/\/telegra.ph(.*?)"/', $line, $figure_match);
            if ($figure_match) {
                $line = str_replace("https:\/\/telegra.ph", "", $line);
            }
            $chapters[$chapter][] = $line;
        }
        
        $found_params['chapters'] = $chapters;
        
        return $found_params;
    }
    
}

if (! function_exists('translit_ukr')) {
    function translit_ukr($s) {
        $s = (string) $s; 
        $s = trim($s);
        $s = strtr($s, array('зг'=>'zgh','а'=>'a','б'=>'b','в'=>'v','г'=>'h','ґ'=>'g','д'=>'d','е'=>'e','є'=>'ie','ж'=>'zh','з'=>'z','и'=>'y','і'=>'i','ї'=>'i','й'=>'i','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'kh','ц'=>'ts','ч'=>'ch','ш'=>'sh','щ'=>'shch','ю'=>'iu','я'=>'ia','`'=>'','ь'=>'','Зг'=>'Zgh','А'=>'A','Б'=>'B','В'=>'V','Г'=>'H','Ґ'=>'G','Д'=>'D','Е'=>'E','Є'=>'Ye','Ж'=>'Zh','З'=>'Z','И'=>'Y','І'=>'I','Ї'=>'Yi','Й'=>'Y','К'=>'K','Л'=>'L','М'=>'M','Н'=>'N','О'=>'O','П'=>'P','Р'=>'R','С'=>'S','Т'=>'T','У'=>'U','Ф'=>'F','Х'=>'Kh','Ц'=>'Ts','Ч'=>'Ch','Ш'=>'Sh','Щ'=>'Shch','Ю'=>'Yu','Я'=>'Ya')); // згідно Паспорта (КМУ 2010) 

        $s = preg_replace("/[^A-Za-z0-9 ]/", '', $s);

        $s = str_replace(' ', '-', $s);

        return $s; // повертаємо результат
    }
}

if (! function_exists('modify_image_name')) {
    function modify_image_name($image_name, $modify) {
        $parts = explode('/', $image_name);
        $filename = end($parts);
        unset($parts[count($parts) - 1]);
        $path = implode(DIRECTORY_SEPARATOR, $parts);
        return $path . DIRECTORY_SEPARATOR . $modify . $filename;
    }
}

if (! function_exists('modify_image_name_url')) {
    function modify_image_name_url($image_name, $modify) {
        $parts = explode('/', $image_name);
        $filename = end($parts);
        unset($parts[count($parts) - 1]);
        $path = implode('/', $parts);
        return $path . '/' . $modify . $filename;
    }
}

if (! function_exists('format_chapter_output')) {
    function format_chapter_output($chapter) {
        preg_match_all('/<figure>(.*?)<\/figure>/', $chapter, $output_array);
        
        $chapter = str_replace('????', ' - ', $chapter);
        
        $figures = [];
        if ($output_array) {
            foreach ($output_array[0] as $figure) {
                $chapter = str_replace($figure, '', $chapter);
                preg_match('/src="(.*?)"/', $figure, $figure_match);
                if ($figure_match) {
                    $img_url = site_url('image' . modify_image_name_url($figure_match[1], 'horizontal_'));
                    $figure = str_replace($figure_match[1], $img_url, $figure);
                    $figure = str_replace('<img', '<img class="img-fluid"', $figure);
                }
                $figures[] = $figure;
                
            }
        }
        
        return [
            'chapter' => $chapter,
            'figures' => $figures,
        ];
    }
}