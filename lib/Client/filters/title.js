/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Filters.title = function zwigFilterTitle(value) {
    value = stringify(value);

    return value.toLowerCase().replace(/^.|\s.|-.|_./g, function (match) {
        return match.toUpperCase();
    });
};