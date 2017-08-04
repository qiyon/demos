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
    selectQuality();
    function selectQuality(){
        var list = $('.bilibili-player-video-btn-quality').find('.bpui-selectmenu-list-row');
        if (list.length === 0) {
            setTimeout(selectQuality, 1000);
        } else {
            list.get(list.length - 1).click();
        }
    }
})();

