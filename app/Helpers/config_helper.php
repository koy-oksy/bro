<?php

if (! function_exists('get_config')) {
    function get_config(string $param): string
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('config');
        $builder->select('value');
        $builder->where('param', $param);
        $output = $builder->get();
        
        return $output->getRow()->value;
    }

}
