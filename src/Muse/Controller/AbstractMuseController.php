<?php
/**
 * Part of muse project.
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Muse\Controller;

use Muse\IO\IOInterface;
use Windwalker\Structure\Structure;

/**
 * Base controller class.
 */
abstract class AbstractMuseController implements MuseControllerInterface
{
	/**
	 * IO adapter.
	 *
	 * @var IOInterface
	 */
	public $io;

	/**
	 * Instantiate the controller.
	 *
	 * @param   IOInterface $io     The Controller object.
	 * @param   Structure   $config Config
	 */
	public function __construct(IOInterface $io, Structure $config = null)
	{
		$this->io     = $io;
		$this->config = $config ? : new Structure;
	}

	/**
	 * Write a string to standard output.
	 *
	 * @param   string   $text  The text to display.
	 *
	 * @return  AbstractMuseController  Instance of $this to allow chaining.
	 */
	public function out($text = '')
	{
		$this->io->out($text);

		return $this;
	}

	/**
	 * Write a string to standard error output.
	 *
	 * @param   string   $text  The text to display.
	 *
	 * @return  AbstractMuseController  Instance of $this to allow chaining.
	 */
	public function err($text = '')
	{
		$this->io->err($text);

		return $this;
	}

	/**
	 * Get a value from standard input.
	 *
	 * @param   string  $question  The question you want to ask user.
	 *
	 * @return  string  The input string from standard input.
	 */
	public function in($question = '')
	{
		return $this->io->in($question);
	}

	/**
	 * Close system.
	 *
	 * @param string $text Close message.
	 *
	 * @return  void
	 */
	public function close($text = '')
	{
		$this->io->close($text);
	}
}
