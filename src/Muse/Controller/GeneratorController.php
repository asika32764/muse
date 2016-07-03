<?php
/**
 * Part of muse project.
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Muse\Controller;

/**
 * Main entry of Code Generator.
 */
class GeneratorController extends AbstractMuseController
{
	/**
	 * Task name.
	 *
	 * @var string
	 */
	protected $task = null;

	/**
	 * Template prefix.
	 *
	 * Replace it in extended class if you want to integrate to other system..
	 *
	 * @var  string
	 */
	protected $templateName = '%sTemplate\\%sTemplate';

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
	public function execute()
	{
		$template = $this->io->getArgument(0) ? : exit("Please give me a template name.\n");

		$this->config['template'] = $template;

		// Get Template Handler
		$class = sprintf($this->templateName, ucfirst($template), ucfirst($template));

		if (!class_exists($class))
		{
			throw new \LogicException(sprintf('Template "%s" not found.', $template));
		}

		/** @var $template \Muse\Template\AbstractTemplate */
		$template = new $class($this->io, $this->config);

		if ($template->setTask($this->getTask())->execute())
		{
			$this->out()->out('Template generated.');

			return true;
		}

		return false;
	}

	/**
	 * Task getter.
	 *
	 * @return  string Task name.
	 */
	public function getTask()
	{
		return $this->task;
	}

	/**
	 * Task setter.
	 *
	 * @param   string $task  Task name.
	 *
	 * @return  GeneratorController  Return self to support chaining.
	 */
	public function setTask($task)
	{
		$this->task = $task;

		return $this;
	}
}
