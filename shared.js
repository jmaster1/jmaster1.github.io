function setLangLinkHref(id, lang) {
    let link = document.getElementById(id);
    var match = window.location.href.match('/pages/(.*)/(.*)');
    link.setAttribute("href", '/pages/'+ lang + '/' + match[2]);
}

document.addEventListener("DOMContentLoaded", function() {
    setLangLinkHref('langLink_et', 'et');
    setLangLinkHref('langLink_ru', 'ru');
    setLangLinkHref('langLink_en', 'en');
});

setInterval(function () {
    document.querySelectorAll("#logo > img").forEach(img => {
        let display = window.getComputedStyle(img, null).display;
        if(display != "none") {
            let rect = img.getBoundingClientRect();
            let d = document.getElementById("langLinks");
            d.style.position = "absolute";
            d.style.left = rect.left + 'px';
            d.style.top = (rect.top + 3) +'px';

            let l = document.getElementById("logoLink");
            l.style.position = "absolute";
            l.style.left = (rect.left + 36) + 'px';
            l.style.top = (rect.top + 0) +'px';
            l.style.width = (rect.height + 15) + 'px';
            l.style.height = rect.height + 'px';
        }
    });
}, 200);


jQuery(function($){
    $(document).ready(function(){
        $(".logoall").click(function(){
            if($(".logoall > .button_label").text() == "Показать всеx"){
                var lsetw = $("#lset").width();
                var lseth = 130 * Math.ceil(60 / (Math.floor(lsetw / 297)));
                $("#lset").stop().animate({height:lseth}, 500);
                $(".logoall > .button_label").text('Скрыть');
                $(".logoall > .button_icon > i").toggleClass("icon-up");
            } else {
                $("#lset").stop().animate({height:"260px"}, 500);
                $(".logoall > .button_label").text('Показать всеx');
                $(".logoall > .button_icon > i").toggleClass("icon-up");
            }
        });

        $(".ptlogoall").click(function(){
            if($(".ptlogoall > .button_label").text() == "Показать всеx"){
                var plsetw = $("#plset").width();
                var plseth = 130 * Math.ceil(66 / (Math.floor(plsetw / 186)));
                $("#plset").stop().animate({height:plseth}, 500);
                $(".ptlogoall > .button_label").text('Скрыть');
                $(".ptlogoall > .button_icon > i").toggleClass("icon-up");
            } else {
                $("#plset").stop().animate({height:"260px"}, 500);
                $(".ptlogoall > .button_label").text('Показать всеx');
                $(".ptlogoall > .button_icon > i").toggleClass("icon-up");
            }
        });
    });
});

function scroll0() {
    window.scrollTo(0,0);
}

window.onload = function(){
    scroll0();
    setTimeout(scroll0, 111);
}