<?php
/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['content']['contaoMaps'] = array
(
    'tables' => array('tl_contaoMaps'),
    'icon'   => 'system/modules/contaoMaps/assets/images/contaoMaps-icon.png'
);

/**
 * Frontend modules
 */
$GLOBALS['FE_MOD']['contaoMaps'] = array
(
    'map_list' => 'ModuleContaoMapsList',
);

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array
(
    'CMgetMap',
    'getMap'
);

$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array
(
    'CMmapLink',
    'mapLink'
);


/**
 * Content element
 */
$GLOBALS['TL_CTE']['contaoMaps'] = array
(
    'map_list'   => 'ModuleContaoMapsList',
    'single_map' => 'ModuleContaoMapsSingle',
);