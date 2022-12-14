$(document).ready(function () {

    $('div.bgParallax').each(function () {
        var $obj = $(this);

        $(window).scroll(function () {
            var yPos = -($(window).scrollTop() / $obj.data('speed'));

            var bgpos = '50% ' + yPos + 'px';

            $obj.css('background-position', bgpos);

        });
    });

});

$(document).ready(function () {

    var defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 1200,
        easingType: 'linear'
    };


    $().UItoTop({easingType: 'easeOutQuart'});

    $(".scroll").click(function (event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top}, 700);
    });

});

if (document.getElementById("mapa_contato")) {
    function init_map1() {
        var myLocation = new google.maps.LatLng(-4.27131308, -55.98034948);
        var mapOptions = {
            center: myLocation,
            zoom: 16
        };
        var marker = new google.maps.Marker({
            position: myLocation,
            title: "Localização dos imoveis da Kananda Imobiliaria!",
            icon: "imagens/marcado.png"
        });
        var map = new google.maps.Map(document.getElementById("mapa_contato"),
                mapOptions);
        marker.setMap(map);
    }
    init_map1();
}