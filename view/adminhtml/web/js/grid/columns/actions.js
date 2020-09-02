/**
 * A Magento 2 module named Experius/EmailCatcher
 * Copyright (C) 2019 Experius
 *
 * This file included in Experius/EmailCatcher is licensed under OSL 3.0
 *
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Please see LICENSE.txt for the full text of the OSL 3.0 license
 */
define([
    'underscore',
    'mageUtils',
    'uiRegistry',
    'Magento_Ui/js/grid/columns/actions',
    'Magento_Ui/js/modal/confirm'
], function (_, utils, registry, Column, confirm) {
    'use strict';

    return Column.extend({
        isHandlerRequired: function (actionIndex, rowIndex) {
            var action = this.getAction(rowIndex, actionIndex);

            return _.isObject(action.callback) || action.confirm || !action.href || action.popup;
        },
        applyAction: function (actionIndex, rowIndex) {
            var action = this.getAction(rowIndex, actionIndex),
                callback = this._getCallback(action);

            if (action.popup) {
                this._popup(action, callback);
            } else {
                action.confirm ?
                    this._confirm(action, callback) :
                    callback();
            }

            return this;
        },
        _popup: function (action, callback) {
            window.open(action.href,'_blank','width=800,height=700,resizable=1,scrollbars=1');return false;
        }
    });
});
