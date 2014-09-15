<?php

/**
 * ModuleContaoMapsList
 *
 * Copyright (c) 2014 by ostec
 *
 * @link    https://www.ostec.de
 */
class ModuleContaoMapsList extends Module
{
    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'static';
    protected $mapList;
    protected $mapTypes = array(
        1 => 'roadmap',
        2 => 'satellite',
        3 => 'hybrid',
        4 => 'terrain',
    );

    /**
     * Compile the current element
     */
    protected function compile()
    {
        /** @var \Contao\Database\Result $rs */
        $rs = DATABASE::getInstance()
                      ->query('SELECT * FROM tl_contaoMaps')
                      ->fetchAllAssoc();

        $this->import('Environment');

        foreach ($rs as $map) {
            switch ($map['mapMode']) {
                case 2:
                    $this->functionalMap($map);
                    break;
                default:
                    $this->staticMap($map);
            }
        }
    }

    protected function functionalMap($map)
    {

    }

    protected function staticMap($map)
    {
        $mapLink = 'http://maps.googleapis.com/maps/api/staticmap?'.
                   'maptype='.$this->mapTypes[$map['mapType']].
                   '&zoom='.$map['zoom'].
                   '&sensor=false'.
                   ($this->Environment->agent->mobile ? '&scale=2' : '');

        if ($map['useLongitudeAndLatitude']) {
            $map['longitudeAndLatitude'] = implode(',', $map['longitudeAndLatitude']);
            $adress                      = $map['longitudeAndLatitude'];

        } else {
            $map['adress'] = str_replace(" ", '+', $map['adress']);
            $adress        = $map['adress'];
        }

        if ($map['showMark']) {
            $mapLink .= '&markers=size:mid|color:red|'.$adress;
        } else {
            $mapLink .= '&center='.$adress;
        }

        $this->appButton($map, $adress);
        $this->Template->mapID   = $map['id'];
        $this->Template->mapLink = $mapLink;
        $this->Template->script  = '<script async="async">'.
                                   str_replace(
                                       array('%id%', '%mapLink%', '%name%'),
                                       array($map['id'], $mapLink, $map['name']),
                                       file_get_contents(dirname(__FILE__).'/../assets/js/autoSize.js')
                                   ).
                                   '</script>';
    }

    protected function appButton($map, $adress)
    {
        $appButton = '';

        if ($map['appButton']) {
            switch ($this->Environment->agent->os) {
                case 'ios':
                case 'mac':
                    $appButton = '<a href="http://maps.apple.com/maps?q='.$adress.'">In Karten öffnen</a>';
                    break;
                case 'win-ce':
                case 'win':
                case 'android':
                    $appButton = '<a href="http://maps.google.com/maps?q='.$adress.'">In Google Maps öffnen</a>';
                    break;
                default:
                    $appButton = '<a href="http://maps.google.com/maps?q='.$adress.'">Zu Google Maps wechseln</a>';
            }
        }

        $this->Template->appButton = $appButton;
    }
}
