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
 * Compiles a node that checks if a string starts with another string.
 * @see http://twig.sensiolabs.org/doc/templates.html#comparisons
 */
class ExpressionBinaryStartsWith extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Expression_Binary_StartsWith';

    /**
     * @param Twig_Node $node
     * @return Segment
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Twig_Node $node)
    {
        return new Segment('functions.startsWith(%s, %s)', [
            $this->getCompiledNode($node, 'left'),
            $this->getCompiledNode($node, 'right')
        ]);
    }
}