<?php
/**
 * Part of muse project.
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace TemplateTemplate\Action;

use Muse\Action\AbstractAction;
use Muse\FileOperator\ConvertOperator;
use Muse\Filesystem\Folder;

/**
 * Class ConvertAction
 *
 * @since 1.0
 */
class ConvertAction extends AbstractAction
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$convertOperator = new ConvertOperator($this->io);

		// Delete old folder first.
		if (file_exists($this->config['path.dest']))
		{
			Folder::delete($this->config['path.dest']);
		}

		// Do convert.
		$convertOperator->copy($this->config['path.src'], $this->config['path.dest'], $this->replace);
	}
}
