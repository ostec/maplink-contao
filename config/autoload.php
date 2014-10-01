<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package ContaoMaps
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'CMgetMap'               => 'system/modules/contaoMaps/modules/CMgetMap.php',
	'ModuleContaoMapsList'   => 'system/modules/contaoMaps/modules/ModuleContaoMapsList.php',
	'ModuleContaoMapsSingle' => 'system/modules/contaoMaps/modules/ModuleContaoMapsSingle.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'list'   => 'system/modules/contaoMaps/templates',
	'single' => 'system/modules/contaoMaps/templates',
));
