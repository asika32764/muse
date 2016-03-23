<?php
/**
 * Part of muse project.
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Muse\FileOperator;

use Muse\Filesystem\File;
use Muse\Filesystem\Path;
use Muse\IO\IOInterface;
use Windwalker\String\SimpleTemplate;

/**
 * Copy Operator
 */
class CopyOperator extends AbstractFileOperator
{
	/**
	 * Replace string.
	 *
	 * @var array
	 */
	protected $replace = array();

	/**
	 * Default {@...@} to prevent twig conflict.
	 *
	 * @var  array
	 */
	protected $tagVariable = array();

	/**
	 * Constructor.
	 *
	 * @param IOInterface $io          IO adapter.
	 * @param array       $tagVariable Tag variable.
	 */
	public function __construct(IOInterface $io, $tagVariable = array('{@', '@}'))
	{
		$this->tagVariable = $tagVariable;

		parent::__construct($io);
	}

	/**
	 * Do copy action.
	 *
	 * @param string $src     Source path.
	 * @param string $dest    Destination path.
	 * @param array  $replace Replace array.
	 *
	 * @return  void
	 */
	public function copy($src, $dest, $replace = array())
	{
		$replace = $replace ? : $this->replace;

		$src  = Path::clean($src);
		$dest = Path::clean($dest);

		if (is_file($src))
		{
			$this->copyFile($src, $dest, $replace);
		}
		elseif (is_dir($src))
		{
			$this->copyDir($src, $dest, $replace);
		}
	}

	/**
	 * Copy per file.
	 *
	 * @param string $src     Source path.
	 * @param string $dest    Destination path.
	 * @param array  $replace Replace array.
	 *
	 * @return  void
	 */
	protected function copyFile($src, $dest, $replace = array())
	{
		// Replace dest file name.
		$dest = SimpleTemplate::render($dest, $replace, $this->tagVariable);

		if (is_file($dest))
		{
			$this->io->out('File exists: ' . $dest);
		}
		else
		{
			// Replace content
			$content = SimpleTemplate::render(file_get_contents($src), $replace, $this->tagVariable);

			if (File::write($dest, $content))
			{
				$this->io->out('File created: ' . $dest);
			}
		}
	}

	/**
	 * Copy whole dir.
	 *
	 * @param string $src     Source path.
	 * @param string $dest    Destination path.
	 * @param array  $replace Replace array.
	 *
	 * @return  void
	 */
	protected function copyDir($src, $dest, $replace = array())
	{
		$dir = new \RecursiveDirectoryIterator($src);

		$dir = new \RecursiveIteratorIterator($dir);

		foreach ($dir as $file)
		{
			/** @var $file \SplFileInfo */
			if ($file->isDir())
			{
				continue;
			}

			$srcFile = $file->getRealPath();

			$destFile = str_replace($src, $dest, $srcFile);

			$this->copyFile($srcFile, $destFile, $replace);
		}
	}

	/**
	 * Replace array getter.
	 *
	 * @return  array
	 */
	public function getReplace()
	{
		return $this->replace;
	}

	/**
	 * Replace array setter.
	 *
	 * @param   array $replace  Replace array.
	 *
	 * @return  CopyOperator  Return self to support chaining.
	 */
	public function setReplace($replace)
	{
		$this->replace = $replace;

		return $this;
	}
}
