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
     * @param int $id
     *
     * @return mixed
     */
    protected function getMap($id)
    {
        $id  = explode('::', $id);
        $id  = $id[1];
        $map = DATABASE::getInstance()
                       ->query('SELECT * FROM tl_contaoMaps WHERE id = '.$id)
                       ->fetchAssoc();

        $this->import('Environment');
        $this->make($map);

        return '<div><div id="cm'.$this->map['mapID'].'" class="contaoMaps">'.
               $this->map['map'].'</div>'.$this->map['appButton'].'</div>';
    }
}