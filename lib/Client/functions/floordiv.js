/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Functions.floordiv = function zwigFunctionFloorDiv(lhs, rhs) {
    return Math.floor(Functions.div(lhs, rhs));
};