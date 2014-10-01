<?php
/**
 * ModuleContaoMapsList
 *
 * Copyright (c) 2014 by ostec
 *
 * @link    https://www.ostec.de
 */
require_once(dirname(__FILE__).'/contaoMapsTrait.php');

class ModuleContaoMapsSingle extends Module
{
    use contaoMaps;

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'list';

    /**
     * Contains maps of done
     *
     * @var array $mapList
     */
    protected $mapList;

    /**
     * Compile the current element
     */
    protected function compile()
    {
        /** @var \Contao\Database\Result $rs */
        $rs = DATABASE::getInstance()
                      ->query('SELECT * FROM tl_contaoMaps ORDER BY id')
                      ->fetchAllAssoc();

        $this->import('Environment');

        foreach ($rs as $map) {
            $this->make($map);

            $this->mapList[] = $this->map;
        }

        $this->Template->mapList = $this->mapList;
    }
}
