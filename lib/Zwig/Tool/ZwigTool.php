<?php
/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

namespace Zwig\Tool;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Zwig\Exception\InvalidParameterException;
use Zwig\Zwig;


class ZwigTool
{
    /**
     * @param array $arguments
     */
    public function run(array $arguments)
    {
        $templatePath = $this->getTemplatesPath($arguments);

        $twigLoader = new Twig_Loader_Filesystem($templatePath);
        $twigEnvironment = new Twig_Environment($twigLoader);

        $zwig = new Zwig($twigEnvironment);

        foreach ($this->getTemplates($templatePath) as $filename => $destination) {
            file_put_contents($destination, $zwig->convertFile($filename));
        }
    }

    /**
     * @param array $argv
     * @return string
     */
    private function getTemplatesPath(array $argv)
    {
        if (!isset($argv[1])) {
            throw new InvalidParameterException("No template path given!");
        }

        if (!is_dir($argv[1])) {
            throw new InvalidParameterException("The template path doesn't exist!");
        }

        return realpath($argv[1]);
    }

    /**
     * @param string $templatePath
     * @return array
     */
    private function getTemplates($templatePath)
    {
        $templates = [];

        $pattern = $templatePath . DIRECTORY_SEPARATOR . '*.twig';
        foreach (glob($pattern) as $path) {
            $filename = basename($path);
            $destination = $templatePath . DIRECTORY_SEPARATOR . basename($path, '.twig') . '.js';

            $templates[$filename] = $destination;
        }

        return $templates;
    }
}