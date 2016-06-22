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

namespace Zwig\NodeHandler;

use Twig_Node;
use Zwig\Exception\NotImplementedException;
use Zwig\Exception\UnknownStructureException;
use Zwig\Sequence\Segment;


/**
 * Compiles a node that represents a ternary operator.
 * @see hhttp://twig.sensiolabs.org/doc/templates.html#other-operators
 */
class ExpressionConditionalHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Expression_Conditional';

    /**
     * @param Twig_Node $node
     * @return Segment
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Twig_Node $node)
    {
        return new Segment('%s ? %s : %s', [
            $this->getCompiledNode($node, 'expr1'),
            $this->getCompiledNode($node, 'expr2'),
            $this->getCompiledNode($node, 'expr3')
        ]);
    }
}