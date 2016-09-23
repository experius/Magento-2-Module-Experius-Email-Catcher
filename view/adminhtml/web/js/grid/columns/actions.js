/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
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

            if(action.popup){
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
