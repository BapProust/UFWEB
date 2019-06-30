(function () {
    var html = document.documentElement;

    function Snowflake(maxX) {
        this.reset(maxX);
    }
    Snowflake.prototype.tick = function () {
        this.y += this.vel;
        this.x += this.sideVel;
    };
    Snowflake.prototype.reset = function (maxX) {
        var chanceOfLargeSnowflake = 0.15;

        this.size = Math.random();
        this.vel = Math.random();

        if (this.size < chanceOfLargeSnowflake) {
            this.size += 2;
        } else {
            this.size += 0.5;
            this.vel *= 0.8;
        }

        this.alpha = 0.5 + Math.random() * 0.8;

        // random x position
        this.x = Math.random() * maxX;
        this.y = -this.size;

        // side-to-side movement
        this.sideVel = (0.5 - Math.random()) * this.vel;

        return this;
    };

    (function () {
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        var settleCanvas = document.createElement('canvas');
        var settleContext = context && settleCanvas.getContext('2d');
        var windowResized;
        var activeFlakes = [];
        var snowflakesPerPixelPerSecond = 0.01;
        var PIx2 = Math.PI * 2;
        var assumedFps = 60;
        var settlePoint;
        var snowflakePool = [];

        function resizeCanvas() {
            settlePoint = Array(html.clientWidth);
            settleCanvas.width = canvas.width = html.clientWidth;
            settleCanvas.height = canvas.height = html.clientHeight;
        }

        function updateSettlePoints(flake) {
            var size = flake.size * 0.8; // reduce coral effect
            var xStart = Math.floor(flake.x - size);
            var range = size * 2;
            var newY;

            if (xStart < 0) {
                range += xStart;
                xStart = 0;
            }
            if (xStart + range > settlePoint.length) {
                range -= xStart + range - settlePoint.length;
            }

            for (var i = 0; i < range; i++) {
                newY = flake.y - (size * Math.cos((i / range) * Math.PI - (Math.PI / 2)));
                settlePoint[i + xStart] = Math.min(settlePoint[i + xStart] || Infinity, newY);
            }
        }

        var flakesToCreate = 0;

        function frame() {
            flakesToCreate += (snowflakesPerPixelPerSecond / assumedFps) * canvas.width;
            var flakesThisFrame = Math.floor(flakesToCreate);
            flakesToCreate -= flakesThisFrame;

            // clear canvas
            if (windowResized) {
                resizeCanvas();
                windowResized = false;
            } else {
                context.clearRect(0, 0, canvas.width, canvas.height);
            }

            // add new flake?
            while (flakesThisFrame--) {
                if (snowflakePool.length) {
                    activeFlakes.push(snowflakePool.pop().reset(canvas.width));
                } else {
                    activeFlakes.push(new Snowflake(canvas.width));
                }
            }

            var i = activeFlakes.length;
            var flake;

            // for each flake...
            while (i--) {
                flake = activeFlakes[i];
                flake.tick();

                // splice flake if it's now out of rendering zone
                if (flake.y >= canvas.height || flake.y >= settlePoint[Math.floor(flake.x)]) {
                    snowflakePool.push.apply(snowflakePool, activeFlakes.splice(i, 1));
                    // this flake effects our settle points
                    if (flake.alpha > 0.8) {
                        updateSettlePoints(flake);
                    }
                    settleContext.fillStyle = 'rgba(18, 95, 105, ' + flake.alpha + ')';
                    settleContext.beginPath();
                    settleContext.arc(flake.x, flake.y, flake.size, 0, PIx2, true);
                    settleContext.closePath();
                    settleContext.fill();
                    continue;
                }

                // render to canvas
                context.fillStyle = 'rgba(18, 95, 105, ' + flake.alpha + ')';
                context.beginPath();
                context.arc(flake.x, flake.y, flake.size, 0, PIx2, true);
                context.closePath();
                context.fill();
            }
            requestAnimationFrame(frame);
        }

        if (context) {
            resizeCanvas();

            // watch out for resizes
            window.addEventListener('resize', function () {
                windowResized = true;
            }, false);

            // add it to the page & start animating
            document.getElementById('background').appendChild(canvas);
            document.getElementById('background').appendChild(settleCanvas);
            requestAnimationFrame(frame);
        }
    })();

})();