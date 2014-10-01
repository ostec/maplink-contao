<?php

/**
 * contaoMapsTrait
 *
 * Copyright (c) 2014 by ostec
 *
 * @link    https://www.ostec.de
 */
trait contaoMaps
{
    /**
     * Operating Systems for default using Functional Map
     *
     * @var array $functional
     */
    protected $functional = array(
        'win',
        'mac',
        'unix'
    );

    /**
     * Supported Map type by googel API
     *
     * @var array $mapTypes
     */
    protected $mapTypes = array(
        1 => 'roadmap',
        2 => 'satellite',
        3 => 'hybrid',
        4 => 'terrain',
    );

    /**
     * Summerized Map
     *
     * @var array $map
     */
    protected $map;

    /**
     * choice the map mode
     *
     * @param $map
     */
    protected function make($map)
    {
        switch ($map['mapMode']) {
            case 1:
                $this->staticMap($map);
                break;
            case 2:
                $this->functionalMap($map);
                break;
            default:
                if (in_array($this->Environment->agent->os, $this->functional)) {
                    $this->functionalMap($map);
                } else {
                    $this->staticMap($map);
                }
        }
    }

    /**
     * summerize map for functional
     *
     * @param $map
     */
    protected function functionalMap($map)
    {
        // Todo implement me!!!
    }

    /**
     * summerize map for static
     *
     * @param $map
     */
    protected function staticMap($map)
    {
        $mapLink = 'http://maps.googleapis.com/maps/api/staticmap?'.
                   'maptype='.$this->mapTypes[$map['mapType']].
                   '&zoom='.$map['zoom'].
                   '&sensor=false'.
                   '&key='.$map['googleApiKey'].
                   ($this->Environment->agent->mobile && $map['mobileScale'] ? '&scale=2' : '');

        if ($map['useLongitudeAndLatitude']) {
            $map['longitudeAndLatitude'] = implode(',', unserialize($map['longitudeAndLatitude']));
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

        $this->map['mapID']   = $map['id'];
        $this->map['mapLink'] = $mapLink;

        $staticSize = unserialize($map['staticSize']);

        if ($map['size'] && $staticSize[0] > 0 && $staticSize[1] > 0) {
            $this->map['map'] = '<img src="'.$mapLink.
                                '&size='.implode('x', $staticSize).
                                '" width="'.$staticSize[0].'" height="'.$staticSize[1].
                                '" title="'.$map['name'].'">';
        } else {
            $this->map['map'] = '<script async="async">'.
                                str_replace(
                                    array('%id%', '%mapLink%', '%name%'),
                                    array($map['id'], $mapLink, $map['name']),
                                    file_get_contents(dirname(__FILE__).'/../assets/js/autoSize.js')
                                ).'</script>';
        }

        $this->appButton($map, $adress);
    }

    /**
     * generate the link button to App or Site
     *
     * @param $map
     * @param $adress
     */
    protected function appButton($map, $adress)
    {
        $appButton = '';

        if ($map['appButton']) {
            switch ($this->Environment->agent->os) {
                case 'ios':
                case 'mac':
                    $message = 'In Karten öffnen';
                    $service = 'apple';
                    break;
                case 'android':
                    $message = 'In Google Maps öffnen';
                    $service = 'google';
                    break;
                case 'win-ce':
                case 'win':
                    if ($this->Environment->agent->browser == 'ie' && $this->Environment->agent->version >= '9') {
                        $message = 'In Bing Maps öffnen';
                        $service = 'bing';
                        break;
                    }
                default:
                    $message = 'Zu Google Maps wechseln';
                    $service = 'google';
            }

            $appButton = '<a href="http://maps.'.$service.'.com/?'.
                         ($service == 'bing' ? 'where' : 'q').'='.$adress.'">'.$message.'</a>';
        }

        $this->map['appButton'] = $appButton;
    }
}