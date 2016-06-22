/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Filters.nl2br = function zwigFilterNl2br(value) {
    return value.replace('\n', '<br />');
};