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

namespace Zwig;

use Twig_Environment;
use Twig_Node;
use Zwig\Exception\NotImplementedException;
use Zwig\Exception\UnknownStructureException;
use Zwig\NodeHandler\AbstractHandler;
use Zwig\Sequence\Command;
use Zwig\Sequence\Segment;


/**
 * Compiles a Twig template into executable JavaScript.
 */
class Compiler
{
    /**
     * @var AbstractHandler[]
     */
    private static $compilers;

    /**
     * @var Twig_Environment
     */
    private $twigEnvironment;


    public function __construct(Twig_Environment $twigEnvironment)
    {
        $this->twigEnvironment = $twigEnvironment;
    }

    /**
     * @param string $source
     * @return string
     */
    public function compileSource($source)
    {
        $token = $this->twigEnvironment->tokenize($source);
        $nodes = $this->twigEnvironment->parse($token);

        $body = $nodes->getNode('body');
        $commands = self::compileNode($body);

        return implode($commands);
    }

    /**
     * @param Twig_Node $node
     * @return Segment|Command[]
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public static function compileNode(Twig_Node $node)
    {
        self::initCompilers();

        $nodeClassName = get_class($node);

        if (!isset(self::$compilers[$nodeClassName])) {
            throw new NotImplementedException(
                sprintf('Unknown node type `%s` at line %s', $nodeClassName, $node->getLine())
            );
        }

        return self::$compilers[$nodeClassName]->compile($node);
    }

    /**
     * @param Segment[] $commands
     */
    private function combineCommands(array &$commands)
    {
        for ($i = count($commands) - 1; $i > 0; $i--) {
            if ($commands[$i - 1]->combine($commands[$i])) {
                unset($commands[$i]);
            }
        }
    }

    private static function initCompilers()
    {
        if (!self::$compilers) {
            self::$compilers = [];

            $pattern = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'NodeHandler' . DIRECTORY_SEPARATOR . '*.php';

            foreach (glob($pattern) as $filename) {
                $compilerClassName = 'Zwig\\NodeHandler\\' . basename($filename, '.php');
                $constantName = $compilerClassName . '::TWIG_NODE_CLASS_NAME';

                if (defined($constantName)) {
                    $twigClassName = constant($constantName);
                    self::$compilers[$twigClassName] = new $compilerClassName();
                }
            }
        }
    }
}