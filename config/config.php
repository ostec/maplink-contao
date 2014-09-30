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
    'CMgetMap','getMap'
);
