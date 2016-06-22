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
 * Compiles a node that concat the values of two nodes.
 * @see http://twig.sensiolabs.org/doc/templates.html#other-operators
 */
class ExpressionBinaryConcatHandler extends AbstractExpressionBinaryHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Expression_Binary_Concat';

    /**
     * @param Twig_Node $node
     * @return Segment
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Twig_Node $node)
    {
        return self::compileBinary($node, '+');
    }
}