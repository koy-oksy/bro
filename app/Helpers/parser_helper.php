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
                $src = "https://telegra.ph" . $output_array[1];
                $parsed_data['image'] = $src;
            }
        }
        
        if ($parsed_data['text']) {
            // try to get other hike data
            $parsed_content = parse_hike_content($parsed_data['text']);
            $parsed_data = array_merge($parsed_data, $parsed_content);
        }
        
        if ($parsed_data['text']) {
            // split to blocks
            preg_match_all('/(<p>|<ul>|<figure>)(.*?)(<\/p>|<\/ul>|<\/figure>)/', $parsed_data['text'], $output_array);
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
                    $found_params[$f_params[trim($name)]] = strip_tags(trim($output_array[5][$key]));
                    $content = str_replace($output_array[0][$key], '', $content);
                }
            } 
        }
        
        $chapters = [];
        $chapter = 0;
        // split content into liness
        preg_match_all('/(<p>|<ul>|<figure>)(.*?)(<\/p>|<\/ul>|<\/figure>)/', $content, $output_array);
        foreach($output_array[0]as $line) {
            preg_match('/<strong>(\s*)День\s\d(.*)<\/strong>/', $line, $found_day);
            if ($found_day || $line == '<hr>') {
                $chapter++;
                if ($line == '<hr>') {
                    continue; // skip line
                }
            }
            $chapters[$chapter][] = $line;
        }
        
        $found_params['chapters'] = $chapters;
        
        return $found_params;
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
}