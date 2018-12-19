
// Google Maps
// google.maps.event.addDomListener(window, 'load', init);

// function init() {
//     // Basic options for a simple Google Map
//     // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
//     var mapOptions = {
//         // How zoomed in you want the map to start at (always required)
//         zoom: 11,
//         scrollwheel: false,
//
//         // The latitude and longitude to center the map (always required)
//         center: new google.maps.LatLng(40.6700, -73.9400), // New York
//
//         // How you would like to style the map.
//         // This is where you would paste any style found on Snazzy Maps.
//         styles:[
//             {
//                 "featureType": "water",
//                 "elementType": "geometry.fill",
//                 "stylers": [
//                     {
//                         "color": "#84818b"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "transit",
//                 "stylers": [
//                     {
//                         "color": "#808080"
//                     },
//                     {
//                         "visibility": "off"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "road.highway",
//                 "elementType": "geometry.stroke",
//                 "stylers": [
//                     {
//                         "visibility": "on"
//                     },
//                     {
//                         "color": "#b3b3b3"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "road.highway",
//                 "elementType": "geometry.fill",
//                 "stylers": [
//                     {
//                         "color": "#ffffff"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "road.local",
//                 "elementType": "geometry.fill",
//                 "stylers": [
//                     {
//                         "visibility": "on"
//                     },
//                     {
//                         "color": "#ffffff"
//                     },
//                     {
//                         "weight": 1.8
//                     }
//                 ]
//             },
//             {
//                 "featureType": "road.local",
//                 "elementType": "geometry.stroke",
//                 "stylers": [
//                     {
//                         "color": "#d7d7d7"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "poi",
//                 "elementType": "geometry.fill",
//                 "stylers": [
//                     {
//                         "visibility": "on"
//                     },
//                     {
//                         "color": "#ebebeb"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "administrative",
//                 "elementType": "geometry",
//                 "stylers": [
//                     {
//                         "color": "#a7a7a7"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "road.arterial",
//                 "elementType": "geometry.fill",
//                 "stylers": [
//                     {
//                         "color": "#ffffff"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "road.arterial",
//                 "elementType": "geometry.fill",
//                 "stylers": [
//                     {
//                         "color": "#ffffff"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "landscape",
//                 "elementType": "geometry.fill",
//                 "stylers": [
//                     {
//                         "visibility": "on"
//                     },
//                     {
//                         "color": "#efefef"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "road",
//                 "elementType": "labels.text.fill",
//                 "stylers": [
//                     {
//                         "color": "#696969"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "administrative",
//                 "elementType": "labels.text.fill",
//                 "stylers": [
//                     {
//                         "visibility": "on"
//                     },
//                     {
//                         "color": "#737373"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "poi",
//                 "elementType": "labels.icon",
//                 "stylers": [
//                     {
//                         "visibility": "off"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "poi",
//                 "elementType": "labels",
//                 "stylers": [
//                     {
//                         "visibility": "off"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "road.arterial",
//                 "elementType": "geometry.stroke",
//                 "stylers": [
//                     {
//                         "color": "#d6d6d6"
//                     }
//                 ]
//             },
//             {
//                 "featureType": "road",
//                 "elementType": "labels.icon",
//                 "stylers": [
//                     {
//                         "visibility": "off"
//                     }
//                 ]
//             },
//             {},
//             {
//                 "featureType": "poi",
//                 "elementType": "geometry.fill",
//                 "stylers": [
//                     {
//                         "color": "#dadada"
//                     }
//                 ]
//             }
//         ]} ;
//
//     // Get the HTML DOM element that will contain your map
//     // We are using a div with id="map" seen below in the <body>
//     var mapElement = document.getElementById('map');
//
//     // Create the Google Map using our element and options defined above
//     var map = new google.maps.Map(mapElement, mapOptions);
//
//     // Let's also add a marker while we're at it
//     var image = 'images/flag.png';
//     var myLatLng = new google.maps.LatLng(40.6700, -73.9400);
//     var beachMarker = new google.maps.Marker({
//         position: myLatLng,
//         map: map,
//         icon: image
//     });
// }
// Google Maps end


jQuery(document).ready(function( $ ) {
    // subscribe:
    // $("#buttonSubscribe").click(function(){
    //     var vemail = $("#email").val();
    //     if(vemail=='')
    //     {
    //         alert("Please fill out the form");
    //     }
    //     else if(vemail==''){alert('Email field is required')}
    //     else{
    //         $.get("php/email.php", { email:vemail },
    //             function(response, status){
    //                 $("#email").val('');
    //                 alert(response+"\n\nStatus : " + status);
    //             });
    //     }
    // });

    // contact
    // $("#buttonContact").click(function(){
    //     var vname = $("#InputName").val();
    //     var vemail = $("#InputEmail").val();
    //     var vmessage = $("#InputMessage").val();
    //     if(vname=='' || vemail=='' || vmessage=='')
    //     {
    //         alert("Please fill out the form");
    //     }
    //     else{
    //         $.get("php/contact.php", { name:vname,email:vemail,message:vmessage },
    //             function(response, status){
    //                 $("#InputName").val('');
    //                 $("#InputEmail").val('');
    //                 $("#InputMessage").val('');
    //                 alert(response+"\n\nStatus : " + status);
    //             });
    //     }
    // });


    // preloader
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(150).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(150).css({'overflow':'visible'});

    // counterUp
    $('span').counterUp({
        delay: 10, // the delay time in ms
        time: 1000 // the speed time in ms
    });

    // ScrollReveal
    window.sr = new scrollReveal();

    // cache the window object
    $window = $(window);

    $('section[data-type="background"]').each(function(){
// declare the variable to affect the defined data-type
        var $scroll = $(this);

        $(window).scroll(function() {
// HTML5 proves useful for helping with creating JS functions!
// also, negative value because we're scrolling upwards
            var yPos = -($window.scrollTop() / $scroll.data('speed'));

// background position
            var coords = '50% '+ yPos + 'px';

// move the background
            $scroll.css({ backgroundPosition: coords });
        }); // end window scroll
    });  // end section function
});




