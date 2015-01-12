<?php
/**
 * Part of muse project.
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Muse\FileOperator;

use Muse\IO\IOInterface;

/**
 * Abstract FileOperator
 */
class AbstractFileOperator
{
	/**
	 * IO adapter.
	 *
	 * @var  \Muse\IO\IOInterface
	 */
	protected $io;

	/**
	 * Constructor.
	 *
	 * @param IOInterface $io IO adapter.
	 */
	public function __construct(IOInterface $io)
	{
		$this->io = $io;
	}
}
