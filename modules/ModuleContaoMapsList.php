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
    protected $strTemplate = 'list';
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
                      ->query('SELECT * FROM tl_contaoMaps ORDER BY id')
                      ->fetchAllAssoc();

        $functional = array(
            'win','mac','unix'
        );

        $this->import('Environment');

        foreach ($rs as $map) {
            switch ($map['mapMode']) {
                case 1:
                    $this->staticMap($map);
                    break;
                case 2:
                    $this->functionalMap($map);
                    break;
                default:
                    if(in_array($this->Environment->agent->os,$functional)) {
                        $this->functionalMap($map);
                    } else {
                        $this->functionalMap($map);
                    }
            }
        }

        $this->Template->mapList = $this->mapList;
    }

    protected function functionalMap($map)
    {
        // Todo implement me!!!
    }

    protected function staticMap($map)
    {
        $mapLink = 'http://maps.googleapis.com/maps/api/staticmap?'.
                   'maptype='.$this->mapTypes[$map['mapType']].
                   '&zoom='.$map['zoom'].
                   '&sensor=false'.
                   '&key='.$map['googleApiKey'].
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
        $this->mapList[$map['id']]['mapID']   = $map['id'];
        $this->mapList[$map['id']]['mapLink'] = $mapLink;
        $this->mapList[$map['id']]['script']  = '<script async="async">'.
                                                str_replace(
                                                    array('%id%', '%mapLink%', '%name%'),
                                                    array($map['id'], $mapLink, $map['name']),
                                                    file_get_contents(dirname(__FILE__).'/../assets/js/autoSize.js')
                                                ).'</script>';
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
                case 'android':
                    $appButton = '<a href="http://maps.google.com/maps?q='.$adress.'">In Google Maps öffnen</a>';
                    break;
                case 'win-ce':
                case 'win':
                    if($this->Environment->agent->browser.$this->Environment->agent->version >= 'ie9') {
                        $appButton = '<a href="http://maps.bing.com/maps?q='.$adress.'">In Bing Maps öffnen</a>';
                        break;
                    }
                default:
                    $appButton = '<a href="http://maps.google.com/maps?q='.$adress.'">Zu Google Maps wechseln</a>';
            }
        }

        $this->mapList[$map['id']]['appButton'] = "<br>".$appButton;
    }
}
