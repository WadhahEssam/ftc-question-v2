// script for all the pages

$(document).ready(function() {

    //something related to animate.js
    $.fn.extend({
        animateCss: function(animationName, callback) {
            var animationEnd = (function(el) {
                var animations = {
                    animation: 'animationend',
                    OAnimation: 'oAnimationEnd',
                    MozAnimation: 'mozAnimationEnd',
                    WebkitAnimation: 'webkitAnimationEnd',
                };

                for (var t in animations) {
                    if (el.style[t] !== undefined) {
                        return animations[t];
                    }
                }
            })(document.createElement('div'));

            this.addClass('animated ' + animationName).one(animationEnd, function() {
                $(this).removeClass('animated ' + animationName);

                if (typeof callback === 'function') callback();
            });

            return this;
        },
    });

    // starting the website

    if ($("#message").is(":visible") != true) {
        $('#message').fadeIn('slow' , function () {
            setTimeout( messageOut , 3000 );
        });
    }
    function messageOut() {
        $('#message').fadeOut('slow');
    }

}) ;