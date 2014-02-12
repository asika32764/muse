<?php
/**
 * Part of php-code-generator project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace CodeGenerator\Joomla\Command\Generate;

use Joomla\Console\Command\Command;

/**
 * Class Template
 *
 * @since 1.0
 */
class Generate extends Command
{
	/**
	 * Console(Argument) name.
	 *
	 * @var  string
	 *
	 * @since  1.0
	 */
	protected $name = 'gen';

	/**
	 * The command description.
	 *
	 * @var  string
	 *
	 * @since  1.0
	 */
	protected $description = 'Genarate operation.';

	/**
	 * The manual about this command.
	 *
	 * @var  string
	 *
	 * @since  1.0
	 */
	protected $help = <<<HELP
Genarate operation.
HELP;

	/**
	 * The usage to tell user how to use this command.
	 *
	 * @var string
	 *
	 * @since  1.0
	 */
	protected $usage = '%s <cmd><command></cmd> <option>[option]</option>';

	protected function configure()
	{
		// $this->
	}
}
 