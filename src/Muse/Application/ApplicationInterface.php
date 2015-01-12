<?php
/**
 * Part of muse project.
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Muse\Application;

/**
 * Interface ApplicationInterface
 */
interface ApplicationInterface
{
	/**
	 * Get IO adapter.
	 *
	 * @return  \Muse\IO\IOInterface
	 */
	public function getIO();

	/**
	 * Set IO adapter.
	 *
	 * @param   \Muse\IO\IOInterface $io IO adapter.
	 *
	 * @return  ApplicationInterface  Return self to support chaining.
	 */
	public function setIO($io);
}
