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
        'default'      => '{map_legend},name,adress,showMark,googleApiKey;'.
                          '{gfx_legend:hide},mapMode,mapType,appButton,zoom;'.
                          '{mbl_legend:hide},mobileScale;'.
                          '{adv_legend},useLongitudeAndLatitude,longitudeAndLatitude,size,staticSize;',

        '2'            => '{map_legend},name,adress,showMark,googleApiKey;'.
                          '{gfx_legend},mapMode,mapType,appButton,zoom,hideUI;'.
                          '{opt_legend},zoomable,moveable,staticFallback;'.
                          '{mbl_legend:hide},mbl_moveable,mbl_zoomable,mobileScale;'.
                          '{adv_legend},useLongitudeAndLatitude,longitudeAndLatitude,size,staticSize;',
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
            'default'   => '',
            'flag'      => 1,
            'search'    => true,
            'eval'      => array(
                'mandatory'      => true,
                'unique'         => true,
                'decodeEntities' => true,
                'maxlength'      => 127,
                'tl_class'       => 'w50'
            ),
            'sql'       => "varchar(127) NOT NULL"
        ),
        'adress'                  => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['adress'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'default'   => '',
            'search'    => true,
            'eval'      => array(
                'maxlength' => 127,
                'tl_class'  => 'clr w50',
            ),
            'sql'       => "varchar(127)"
        ),
        'showMark'                => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['showMark'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'default'   => true,
            'eval'      => array(
                'tl_class' => 'w50 m12',
            ),
            'sql'       => "boolean NOT NULL"
        ),
        'longitudeAndLatitude'    => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['longitudeAndLatitude'],
            'inputType' => 'text',
            'default'   => '',
            'eval'      => array(
                'multiple' => true,
                'size'     => 2,
                'tl_class' => 'w50'
            ),
            'sql'       => "varchar(255) NOT NULL"
        ),
        'useLongitudeAndLatitude' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['useLongitudeAndLatitude'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'default'   => false,
            'eval'      => array(
                'tl_class' => 'w50 m12',
            ),
            'sql'       => "boolean NOT NULL"
        ),
        'mapMode'                 => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['mapMode'],
            'inputType' => 'select',
            'exclude'   => true,
            'default'   => 1,
            'options'   => array(
                1 => &$GLOBALS['TL_LANG']['tl_contaoMaps']['selection']['mapMode'][1],
                2 => &$GLOBALS['TL_LANG']['tl_contaoMaps']['selection']['mapMode'][2],
            ),
            'eval'      => array(
                'mandatory'      => true,
                'submitOnChange' => true,
                'tl_class'       => 'w50'
            ),
            'sql'       => "tinyint(1) NOT NULL"
        ),
        'mapType'                 => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['mapType'],
            'inputType' => 'select',
            'exclude'   => true,
            'default'   => 1,
            'options'   => array(
                1 => &$GLOBALS['TL_LANG']['tl_contaoMaps']['selection']['mapType'][1],
                2 => &$GLOBALS['TL_LANG']['tl_contaoMaps']['selection']['mapType'][2],
                3 => &$GLOBALS['TL_LANG']['tl_contaoMaps']['selection']['mapType'][3],
                4 => &$GLOBALS['TL_LANG']['tl_contaoMaps']['selection']['mapType'][4],
            ),
            'eval'      => array(
                'mandatory' => true,
                'tl_class'  => 'w50'
            ),
            'sql'       => "tinyint(1) NOT NULL"
        ),
        'appButton'               => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['appButton'],
            'inputType' => 'checkbox',
            'default'   => true,
            'exclude'   => true,
            'eval'      => array(
                'tl_class' => 'clr w50 m12'
            ),
            'sql'       => "boolean NOT NULL"
        ),
        'hideUI'                  => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['hideUI'],
            'inputType' => 'checkbox',
            'exclude'   => true,
            'default'   => false,
            'eval'      => array(
                'tl_class' => 'clr w50 m12'
            ),
            'sql'       => "boolean NOT NULL"
        ),
        'zoom'                    => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['zoom'],
            'inputType' => 'select',
            'exclude'   => true,
            'mandatory' => true,
            'default'   => 16,
            'options'   => $zoomSteps,
            'eval'      => array(
                'tl_class' => 'w50'
            ),
            'sql'       => "tinyint(2) NOT NULL"
        ),
        'size'                    => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['size'],
            'inputType' => 'checkbox',
            'default'   => false,
            'exclude'   => true,
            'eval'      => array(
                'submitOnChange' => true,
                'tl_class' => 'clr w50 m12'
            ),
            'sql'       => "BOOLEAN NOT NULL"
        ),
        'staticSize'              => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['staticSize'],
            'inputType' => 'text',
            'default'   => 0,
            'eval'      => array(
                'multiple' => true,
                'size'     => 2,
                'tl_class' => 'w50'
            ),
            'sql'       => "varchar(255) NOT NULL"
        ),
        'mobileScale'             => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['mobileScale'],
            'inputType' => 'checkbox',
            'default'   => false,
            'eval'      => array(
                'tl_class' => 'clr w50 m12'
            ),
            'sql'       => "boolean NOT NULL"
        ),
        'zoomable' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['zoomable'],
            'inputType' => 'checkbox',
            'default'   => false,
            'eval'      => array(
                'tl_class' => 'clr w50 m12'
            ),
            'sql' => 'boolean NOT NULL'
        ),
        'staticFallback' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['staticFallback'],
            'inputType' => 'checkbox',
            'default'   => false,
            'eval'      => array(
                'tl_class' => 'clr w50 m12'
            ),
            'sql' => 'boolean NOT NULL'
        ),
        'moveable' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['moveable'],
            'inputType' => 'checkbox',
            'default'   => false,
            'eval'      => array(
                'tl_class' => 'w50 m12'
            ),
            'sql' => 'boolean NOT NULL'
        ),
        'mbl_zoomable' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['mbl_zoomable'],
            'inputType' => 'checkbox',
            'default'   => false,
            'eval'      => array(
                'tl_class' => 'w50 m12'
            ),
            'sql' => 'boolean NOT NULL'
        ),
        'mbl_moveable' => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['mbl_moveable'],
            'inputType' => 'checkbox',
            'default'   => false,
            'eval'      => array(
                'tl_class' => 'w50 m12'
            ),
            'sql' => 'boolean NOT NULL'
        ),
        'googleApiKey'            => array(
            'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['googleApiKey'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'search'    => true,
            'default'   => '',
            'eval'      => array(
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class'  => 'w50',
            ),
            'sql'       => "varchar(255)"
        )
    )
);
