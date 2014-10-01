<?php
/**
 * tl_content extension
 *
 * Copyright (c) 2014 by ostec
 *
 * @link    https://www.ostec.de
 */

$maps = array( 0 => '' );
$rs   = DATABASE::getInstance()
                ->query('SELECT id, name FROM tl_contaoMaps ORDER BY name')
                ->fetchAllAssoc();

foreach ($rs as $map) {
    $maps[$map['id']] = $map['name'];
}


// Palettes
$GLOBALS['TL_DCA']['tl_content']['palettes']['map_list'] =
    '{type_legent},type,headline;'.
    '{protected_legend:hide},protected;'.
    '{expert_legend:hide},guest,cssID,space;'.
    '{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['palettes']['single_map'] =
    '{type_legent},type,headline;'.
    '{protected_legend:hide},protected;'.
    '{contaoMaps_legend},cmMapId;'.
    '{expert_legend:hide},guest,cssID,space;'.
    '{invisible_legend:hide},invisible,start,stop';

// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['cmMapId'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_contaoMaps']['ce']['cmMapId'],
    'exclude'   => true,
    'search'    => true,
    'default'   => 0,
    'inputType' => 'select',
    'options'   => $maps,
    'eval'      => array(
        'mandatory'=> true,
        'tl_class' => 'clr w50'
    ),
    'sql'       => "int NULL"
);