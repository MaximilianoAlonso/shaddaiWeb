var conector = (location.href.indexOf('?') == -1) ? '?' : '&';
var site = location.href;
var site_no = ["#"];
$.each(site_no, function(i, v) {
    site = site.replace(v, "");
});

var website = site + conector;

var config = '{}';
if (typeof configuration !== 'undefined') {
    config = configuration;
}

$(function() {
    $('.owl-testimonios').owlCarousel({
        loop: true,
        margin: 30,
        items: 2,
        autoplay: false,
        dots: false,
        nav: false,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 2
            }
        }
    })

    if ($("#map").length > 0) {
        var latlng = new google.maps.LatLng(config.lat, config.lng),
            e, o = [{
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#f5f5f5"
                    }]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#616161"
                    }]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#f5f5f5"
                    }]
                },
                {
                    "featureType": "administrative.land_parcel",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#bdbdbd"
                    }]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#eeeeee"
                    }]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#757575"
                    }]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#e5e5e5"
                    }]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#9e9e9e"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#ffffff"
                    }]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#757575"
                    }]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#dadada"
                    }]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#616161"
                    }]
                },
                {
                    "featureType": "road.local",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#9e9e9e"
                    }]
                },
                {
                    "featureType": "transit.line",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#e5e5e5"
                    }]
                },
                {
                    "featureType": "transit.station",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#eeeeee"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#c9c9c9"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#9e9e9e"
                    }]
                }
            ],
            a = Math.max(document.documentElement.clientWidth, window.innerWidth || 0),
            n = a > 600 ? !0 : !1,
            t = {
                zoom: parseInt(config.zoom),
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: !1,
                draggable: n,
                scrollwheel: !1,
                zoomControl: !0,
                disableDefaultUI: !0,
                mapTypeControlOptions: {
                    mapTypeIds: [google.maps.MapTypeId.ROADMAP, "mapashampersonalizado"]
                }
            };
        e = new google.maps.Map(document.getElementById("map"), t);
        var i = { name: "ASG" },
            r = new google.maps.StyledMapType(o, i);
        e.mapTypes.set("mapashampersonalizado", r), e.setMapTypeId("mapashampersonalizado"),
            new google.maps.Marker({
                map: e,
                animation: google.maps.Animation.DROP,
                position: latlng,
                icon: config.icon
            }),
            new google.maps.InfoWindow;
    }
});

$(document).ready(function() {
    $('.video-gallery').lightGallery();
    $('.owl-clientes').slick({
        infinite: true,
        rows: 2,
        slidesToShow: 4,
        slidesToScroll: 4,
        arrows: false,
        dots: true,
        responsive: [{
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
        ]
    });
});