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
	'ModuleContaoMapsList' => 'system/modules/contaoMaps/modules/ModuleContaoMapsList.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'static' => 'system/modules/contaoMaps/templates',
));
