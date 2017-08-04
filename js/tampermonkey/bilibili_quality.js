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
    var max_time = 20 * 1000;
    var counter = 0;
    selectQuality();
    function selectQuality(){
        counter += step_ms;
        var list = $('.bilibili-player-video-btn-quality').find('.bpui-selectmenu-list-row');
        if (list.length === 0) {
            if (counter <= max_time) setTimeout(selectQuality, step_ms);
        } else {
            list.get(list.length - 1).click();
        }
    }
})();

