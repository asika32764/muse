<?php
/**
 * Part of muse project.
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Muse\Controller;

use Muse\Action\AbstractAction;
use Muse\IO\IOInterface;
use Windwalker\Structure\Structure;

/**
 * Base controller of task.
 */
abstract class AbstractTaskController extends AbstractController
{
	/**
	 * Property config.
	 *
	 * @var Structure
	 */
	public $config = null;

	/**
	 * Property replace.
	 *
	 * @var  array
	 */
	public $replace = array();

	/**
	 * Constructor.
	 *
	 * @param IOInterface $io      IO adapter.
	 * @param Structure   $config  Config.
	 * @param array       $replace Replacing string array.
	 */
	public function __construct(IOInterface $io, Structure $config = null, $replace = array())
	{
		$this->replace = $replace;

		parent::__construct($io, $config);
	}

	/**
	 * Do an action by action class.
	 *
	 * @param AbstractAction $action Action class.
	 *
	 * @return  AbstractTaskController  Return self to support chaining.
	 */
	public function doAction(AbstractAction $action)
	{
		$action->execute($this);

		return $this;
	}

	/**
	 * Get config.
	 *
	 * @param string $key     Config key.
	 * @param string $default Default value if not exists.
	 *
	 * @return  mixed
	 */
	public function get($key, $default)
	{
		return $this->config->get($key, $default);
	}

	/**
	 * Set config.
	 *
	 * @param string $key   Config key.
	 * @param string $value Value you want to set.
	 *
	 * @return  AbstractTaskController  Return self to support chaining.
	 */
	public function set($key, $value)
	{
		$this->config->set($key, $value);

		return $this;
	}

	/**
	 * Get config object.
	 *
	 * @return  Structure Config object.
	 */
	public function getConfig()
	{
		return $this->config;
	}

	/**
	 * Set config object
	 *
	 * @param   Structure $config Config object.
	 *
	 * @return  AbstractTaskController  Return self to support chaining.
	 */
	public function setConfig($config)
	{
		$this->config = $config;

		return $this;
	}
}
