// ==UserScript==
// @name         Bilibili player quality
// @namespace    https://www.bilibili.com/
// @version      0.1
// @description  Try to select video quality
// @author       qiyon <heqiyon@gmail.com>
// @match        https://www.bilibili.com/*
// @grant        none
// ==/UserScript==
(function() {
    'use strict';
    var step_ms = 1000;
    var left_ms = 20 * 1000;
    selectQuality();
    function selectQuality(){
        left_ms -= step_ms;
        var list = $('.bilibili-player-video-btn-quality').find('.bpui-selectmenu-list-row');
        if (list.length === 0) {
            if (left_ms >= 0) setTimeout(selectQuality, step_ms);
        } else {
            list.get(list.length - 1).click();
        }
    }
})();

