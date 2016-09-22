/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'underscore',
    'mageUtils',
    'uiRegistry',
    'Magento_Ui/js/grid/columns/column/actions',
    'Magento_Ui/js/modal/confirm'
], function (_, utils, registry, Column, confirm) {
    'use strict';

    return Column.extend({
        _popop: function (action, callback) {
            window.open(action.href,'_blank','width=800,height=700,resizable=1,scrollbars=1');return false;
        }
    });
});
