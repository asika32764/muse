<?php
/**
 * Part of muse project.
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace AcmeTemplate;

use Muse\IO\IOInterface;
use Muse\Template\AbstractTemplate;
use Windwalker\Structure\Structure;

/**
 * Class AcmeController
 *
 * @since 1.0
 */
class AcmeTemplate extends AbstractTemplate
{
	/**
	 * Using {@...@} to prevent twig conflict.
	 *
	 * @var  array
	 */
	protected $tagVariable = array('{@', '@}');

	/**
	 * registerReplaces
	 *
	 * @param IOInterface $io
	 * @param array       $replace
	 *
	 * @return  array
	 */
	protected function registerReplaces($io, $replace = array())
	{
		$replace['item.lower'] = 'article';
		$replace['item.upper'] = 'ARTICLE';
		$replace['item.cap']   = 'Article';

		return $replace;
	}

	/**
	 * registerConfig
	 *
	 * @param IOInterface     $io
	 * @param array|Structure $config
	 *
	 * @return  array
	 */
	protected function registerConfig($io, $config)
	{
		$subTemplate = $io->getOption('t', 'default');
		$dest        = $io->getArgument(1) ? : 'dest';

		$config['path.src']  = __DIR__ . '/Template/' . $subTemplate;
		$config['path.dest'] = GENERATOR_PATH . '/' . $dest;

		return $config;
	}
}
