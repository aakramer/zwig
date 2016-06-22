/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

Functions.range = function zwigFunctionRange(lhs, rhs) {
    var isString = typeof lhs == 'string';

    if (isString) {
        lhs = lhs.charCodeAt(0);
        rhs = rhs.charCodeAt(0);
    }

    var list = lhs < rhs ? rangeUpwards(lhs, rhs) : rangeDownwards(lhs, rhs);

    if (isString) {
        list = rangeCharList(list);
    }

    return list;
};

function rangeDownwards(lhs, rhs) {
    var list = [];
    for (var i = lhs; i >= rhs; i--) {
        list.push(i);
    }

    return list;
}

function rangeUpwards(lhs, rhs) {
    var list = [];
    for (var i = lhs; i <= rhs; i++) {
        list.push(i);
    }

    return list;
}

function rangeCharList(list) {
    for (var i = 0; i < list.length; i++) {
        list[i] = String.fromCharCode(list[i]);
    }

    return list;
}