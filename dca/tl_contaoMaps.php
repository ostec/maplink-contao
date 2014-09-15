<?php
/**
 * tl_contaoMaps
 *
 * Copyright (c) 2014 by ostec
 *
 * @link    https://www.ostec.de
 */

$zoomSteps = array();

for ($i = 0; $i <= 25; $i++) {
    $zoomSteps[$i] = $i;
}

/**
 * Table tl_theme
 */
$GLOBALS['TL_DCA']['tl_contaoMaps'] = array
(

    // Config
    'config'   => array
    (
        'dataContainer'    => 'Table',
        'enableVersioning' => true,
        'sql'              => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),
    // List
    'list'     => array
    (
        'sorting'           => array
        (
            'mode'        => 2,
            'fields'      => array('name'),
            'flag'        => 1,
            'panelLayout' => 'sort,search,limit'
        ),
        'label'             => array
        (
            'fields' => array('name'),
            'format' => '%s',
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations'        => array
        (
            'edit'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_contaoMaps']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif'
            ),
            'delete' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_contaoMaps']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' =>
                    'onclick="if(!confirm(\''.
                    $GLOBALS['TL_LANG']['MSC']['deleteConfirm'].
                    '\'))return false;Backend.getScrollOffset()"'
            ),
            'show'   => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_contaoMaps']['show'],
                'href'       => 'act=show',
                'icon'       => 'show.gif',
                'attributes' => 'style="margin-right:3px"'
            )
        )
    ),
    // Palettes
    'palettes' => array
    (
        '__selector__' => array('mapMode'),
        'default'      => '{map_legend},name,adress,showMark,longitudeAndLatitude,useLongitudeAndLatitude;'.
                          '{gfx_legend},mapMode,mapType,appButton,zoom;',
        '2'            => '{map_legend},name,adress,showMark,longitudeAndLatitude,useLongitudeAndLatitude;'.
                          '{gfx_legend},mapMode,mapType,appButton,hideUI,zoom;'.
                          '{adv_legend},googleApiKey;',
    ),
    // Fields
    'fields'   => array
    (
        'id'                      => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp'                  => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'name'                    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['name'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'flag'      => 1,
            'search'    => true,
            'eval'      => array(
                'mandatory'      => true,
                'unique'         => true,
                'decodeEntities' => true,
                'maxlength'      => 127,
                'tl_class'       => 'w50'
            ),
            'sql'       => "varchar(127) NOT NULL default ''"
        ),
        'adress'                  => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['adress'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'search'    => true,
            'eval'      => array(
                'maxlength' => 127,
                'tl_class'  => 'clr w50',
            ),
            'sql'       => "varchar(127) default ''"
        ),
        'showMark'                => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['showMark'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => array(
                'tl_class' => 'w50 m12',
            ),
            'sql'       => "boolean NOT NULL default true"
        ),
        'longitudeAndLatitude'    => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['longitudeAndLatitude'],
            'inputType' => 'text',
            'eval'      => array(
                'multiple' => true,
                'size'     => 2,
                'tl_class' => 'clr w50'
            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'useLongitudeAndLatitude' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['useLongitudeAndLatitude'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => array(
                'tl_class' => 'w50 m12',
            ),
            'sql'       => "boolean NOT NULL default false"
        ),
        'mapMode'                 => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['mapMode'],
            'inputType' => 'select',
            'exclude'   => true,
            'mandatory' => true,
            'options'   => array(
                1 => &$GLOBALS['TL_LANG']['tl_contaoMaps']['selection']['mapMode'][1],
                2 => &$GLOBALS['TL_LANG']['tl_contaoMaps']['selection']['mapMode'][2],
            ),
            'eval'      => array(
                'submitOnChange' => true,
                'tl_class'       => 'w50'
            ),
            'sql'       => "tinyint(1) NOT NULL default 1"
        ),
        'mapType'                 => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['mapType'],
            'inputType' => 'select',
            'exclude'   => true,
            'mandatory' => true,
            'options'   => array(
                1 => &$GLOBALS['TL_LANG']['tl_contaoMaps']['selection']['mapType'][1],
                2 => &$GLOBALS['TL_LANG']['tl_contaoMaps']['selection']['mapType'][2],
                3 => &$GLOBALS['TL_LANG']['tl_contaoMaps']['selection']['mapType'][3],
                4 => &$GLOBALS['TL_LANG']['tl_contaoMaps']['selection']['mapType'][4],
            ),
            'eval'      => array(
                'tl_class' => 'w50'
            ),
            'sql'       => "tinyint(1) NOT NULL default 1"
        ),
        'appButton'               => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['appButton'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => array(
                'tl_class' => 'clr w50 m12'
            ),
            'sql'       => "boolean NOT NULL default true"
        ),
        'hideUI'                  => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['hideUI'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'eval'      => array(
                'tl_class' => 'w50 m12'
            ),
            'sql'       => "boolean NOT NULL default false"
        ),
        'zoom'                    => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['zoom'],
            'inputType' => 'select',
            'exclude'   => true,
            'mandatory' => true,
            'options'   => $zoomSteps,
            'eval'      => array(
                'tl_class' => 'clr w50'
            ),
            'sql'       => "tinyint(2) NOT NULL default 16"
        ),
        'googleApiKey'            => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['googleApiKey'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'search'    => true,
            'eval'      => array(
                'maxlength' => 255,
                'tl_class'  => 'w50',
            ),
            'sql'       => "varchar(255) default ''"
        )
    )
);
