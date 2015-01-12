<?php
/**
 * Part of muse project.
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Muse\Windwalker;

use Windwalker\Console\Console;
use Windwalker\Console\IO\IOInterface;
use Windwalker\Registry\Registry;
use Muse\Windwalker\Command;

/**
 * Application of Muse Console
 */
class Application extends Console
{
	/**
	 * IO adapter.
	 *
	 * @var  IO
	 */
	public $io = null;

	/**
	 * The Console title.
	 *
	 * @var  string
	 */
	protected $name = 'Muse - The PHP Code Generator';

	/**
	 * Version of this application.
	 *
	 * @var string
	 */
	protected $version = '1';

	/**
	 * Console description.
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * Class init.
	 *
	 * @param IOInterface $io
	 * @param Registry    $config
	 */
	public function __construct(IOInterface $io = null, Registry $config = null)
	{
		restore_error_handler();
		set_error_handler(array($this, 'error'));

		parent::__construct($io, $config);

		$this->registerCommands();

		$this->setDescription('Muse console application.');

		$this->rootCommand->addGlobalOption('p')
			->alias('path')
			->description('Dest path.');

		$this->rootCommand->addGlobalOption('t')
			->alias('tmpl')
			->defaultValue('default')
			->description('Sub template name.');

		if (defined('PHP_WINDOWS_VERSION_BUILD'))
		{
			$this->rootCommand->addGlobalOption('no-ansi', 1, 'Suppress ANSI colors on unsupported terminals.');
		}

		// Set basic dir.
		define('GENERATOR_PATH', $config['basic_dir.base'] ? : realpath(dirname(__DIR__) . '/../..'));

		$this->setHelp('');
	}

	/**
	 * Register first level commands.
	 *
	 * @return  void
	 */
	protected function registerCommands()
	{
		$this->addCommand(new Command\Generate\Generate);
		$this->addCommand(new Command\Init\Init);
		$this->addCommand(new Command\Convert\Convert);
	}

	/**
	 * The json error handler.
	 *
	 * @param integer $errno      The level of the error raised, as an integer.
	 * @param string  $errstr     The error message, as a string.
	 * @param string  $errfile    The filename that the error was raised in, as a string.
	 * @param integer $errline    The line number the error was raised at, as an integer.
	 * @param mixed   $errcontext An array that points to the active symbol table at the point the error occurred.
	 *                            In other words, errcontext will contain an array of every variable that existed
	 *                            in the scope the error was triggered in. User error handler must not modify error context.
	 *
	 * @throws \ErrorException
	 * @return  void
	 */
	public static function error($errno ,$errstr ,$errfile, $errline ,$errcontext)
	{
		$content = sprintf('%s. File: %s (line: %s)', $errstr, $errfile, $errno);

		$exception = new \ErrorException($content, $errno, 1, $errfile, $errline);

		throw $exception;
	}
}
