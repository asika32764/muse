<?php
/**
 * Part of muse project.
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Muse\Controller;

/**
 * Interface ControllerInterface
 */
interface MuseControllerInterface
{
	/**
	 * Execute the controller.
	 *
	 * @return  boolean  True if controller finished execution, false if the controller did not
	 *                   finish execution. A controller might return false if some precondition for
	 *                   the controller to run has not been satisfied.
	 *
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	public function execute();

	/**
	 * Write a string to standard output.
	 *
	 * @param   string   $text  The text to display.
	 *
	 * @return  MuseControllerInterface  Instance of $this to allow chaining.
	 */
	public function out($text = '');

	/**
	 * Write a string to standard error output.
	 *
	 * @param   string   $text  The text to display.
	 *
	 * @return  MuseControllerInterface  Instance of $this to allow chaining.
	 */
	public function err($text = '');

	/**
	 * Get a value from standard input.
	 *
	 * @param   string  $question  The question you want to ask user.
	 *
	 * @return  string  The input string from standard input.
	 */
	public function in($question = '');

	/**
	 * Close system.
	 *
	 * @param string $text Close message.
	 *
	 * @return  void
	 */
	public function close($text = '');
}
