<?php

/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @see         https://github.com/PHPOffice/PHPWord
 *
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */
declare(strict_types=1);

namespace PhpOffice\PhpWord;

/*
class Autoloader
{
    // @const string 
    const NAMESPACE_PREFIX = 'PhpOffice\\PhpWord\\';

    public static function register(): void
    {
        spl_autoload_register([new self(), 'autoload']);
    }

    public static function autoload(string $class): void
    {
        $prefixLength = strlen(self::NAMESPACE_PREFIX);
        if (0 === strncmp(self::NAMESPACE_PREFIX, $class, $prefixLength)) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, $prefixLength));
            $file = realpath(__DIR__ . (empty($file) ? '' : DIRECTORY_SEPARATOR) . $file . '.php');
            if (!$file) {
                return;
            }
            if (file_exists($file)) {
                // @noinspection PhpIncludeInspection Dynamic includes
                require_once $file;
            }
        }
    }
}
*/
$GLOBALS['class_path'] = array(__DIR__ . '/lib', __DIR__);

// Set-up class_path superglobal variable using php include_path as basis
if (!array_key_exists('class_path', $GLOBALS)) 
{
    $GLOBALS['class_path'] = array();
    foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) 
	{
        // substitute __DIR__ path for '.' instead
        if ($path == '.') 
		{
            array_push( $GLOBALS['class_path'], realpath(__DIR__));
            continue;
        }
        array_push( $GLOBALS['class_path'], realpath($path));
    }
}

if (!function_exists('import')):
	function import($package = '') 
	{
		if (empty($package)) {
			trigger_error("Package path must be specified.", E_USER_ERROR);
		}
		$package_bits = explode('\\', $package);
		$package_path = implode(DIRECTORY_SEPARATOR, $package_bits) . '.php';
		foreach ($GLOBALS['class_path'] as $path) 
		{
			$file = $path . DIRECTORY_SEPARATOR . $package_path;
			if (file_exists($file)) 
			{
				require_once($file);
				$entity_name = implode('\\', $package_bits);
				if (!(class_exists($entity_name, false) || interface_exists($entity_name, false) || trait_exists($entity_name, false))) 
				{
					$caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
					trigger_error("Entity '" . $package . "' not found in file '" . $package_path . "' for import called in " .
									$caller['file'] . " on line " . $caller['line'], E_USER_ERROR);
				}
				return;
			}
		}
	}
endif;

spl_autoload_register('import');