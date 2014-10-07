<?php
/**
 * ModuleContaoMapsSingle
 *
 * Copyright (c) 2014 by ostec
 *
 * @link    https://www.ostec.de
 */
require_once(dirname(__FILE__).'/contaoMapsTrait.php');

class ModuleContaoMapsSingle extends ContentElement
{
    use contaoMaps;

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'single';

    /**
     * Compile the current element
     */
    protected function compile()
    {
        /** @var \Contao\Database\Result $rs */
        $map = DATABASE::getInstance()
                       ->query('SELECT * FROM tl_contaoMaps WHERE id = '.(int)$this->cmMapId)
                       ->fetchAssoc();

        $this->import('Environment');
        $this->make($map);

        $this->Template->map = $this->map;
    }
}
