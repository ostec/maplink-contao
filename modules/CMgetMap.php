<?php
/**
 * CMgetMap
 *
 * Copyright (c) 2014 by ostec
 *
 * @link    https://www.ostec.de
 */
require_once(dirname(__FILE__).'/contaoMapsTrait.php');

class CMgetMap extends Frontend
{
    use contaoMaps;

    /**
     * using by insert tag return map source code
     *
     * @param int $input
     *
     * @return mixed
     */
    protected function getMap($input)
    {
        $input = explode('::', $input);

        if($input[0] != 'getMap') return false;

        $id  = $input[1];
        $map = DATABASE::getInstance()
                       ->query('SELECT * FROM tl_contaoMaps WHERE '.
                               (is_numeric($id) ? 'id = '.$id : 'name = "'.$id.'"'))
                       ->fetchAssoc();

        $this->import('Environment');
        $this->make($map);

        return '<div><div id="cm'.$this->map['mapID'].'" class="contaoMaps">'.
               $this->map['map'].'</div>'.$this->map['appButton'].'</div>';
    }
}