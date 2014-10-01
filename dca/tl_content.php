<?php
$maps = array( 0 => 'WÄHLEN REPLACE ME' ); // todo langs
$rs   = DATABASE::getInstance()
                ->query('SELECT id, name FROM tl_contaoMaps ORDER BY id')
                ->fetchAllAssoc();

foreach ($rs as $map) {
    $maps[$map['id']] = $map['name'];
}

/**
 * Palettes
 */
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

$GLOBALS['TL_DCA']['tl_content']['palettes']['costum_map'] =
    '{type_legent},type,headline;'.
    '{protected_legend:hide},protected;'.
    '{expert_legend:hide},guest,cssID,space;'.
    '{invisible_legend:hide},invisible,start,stop';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['cmMapId'] = array
(
    'label'     => &$GLOBALS['TL_DCA']['tl_contaoMaps']['ce']['cmMapId'],
    'exclude'   => true,
    'search'    => true,
    'default'   => 0,
    'inputType' => 'select',
    'options'   => $maps,
    'sql'       => "int NULL"
);