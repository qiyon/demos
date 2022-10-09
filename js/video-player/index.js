(function () {
    'use strict';

    var fileNode = document.querySelector('input');
    var videoNode = document.querySelector('video');
    var videoConfig = {
        forwardSeconds: 5,
        backwardSeconds: 5
    };
    var playSelectedFile = function () {
        var file = this.files[0];
        var type = file.type;
        var canPlay = videoNode.canPlayType(type);
        if (canPlay === '') {
            alert('Can not play');
        } else {
            videoNode.src = URL.createObjectURL(file);
        }
    };
    var keyCodeMap = {
        37: pressLeft,
        38: pressUp,
        39: pressRight,
        40: pressDown
    };

    function pressUp() {
    }

    function pressDown() {
    }

    function pressRight() {
        frameVideoTime(videoConfig.forwardSeconds);
    }

    function pressLeft() {
        var current = videoNode.currentTime;
        if (videoNode.currentTime > videoConfig.backwardSeconds) {
            videoNode.currentTime = current - videoConfig.backwardSeconds;
        }
    }

    var inFrame = false;
    function frameVideoTime(time) {
        if (inFrame) return;
        inFrame = true;
        var frames = 10, msWait = 50;
        var startTime = videoNode.currentTime;
        timeoutFrameCall(0);

        function timeoutFrameCall(count) {
            if (count < frames) {
                videoNode.currentTime = startTime + (time / frames) * (count + 1);
                setTimeout(function () {
                    timeoutFrameCall(count + 1);
                }, msWait);
            } else {
                inFrame = false;
            }
        }
    }

    fileNode.addEventListener('change', playSelectedFile, false);
    window.document.onkeyup = function (e) {
        if (keyCodeMap[e.keyCode]) {
            var caller = keyCodeMap[e.keyCode];
            caller(e);
        }
    };
})();
