@extends('layouts.app')

<style>
  /* Always set the map height explicitly to define the size of the div
    * element that contains the map. */
  #map {
    height: 200px;
  }
  /* Optional: Makes the sample page fill the window. */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
</style>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- left start col-lg-3 -->
        <div class="col-lg-3 top-space">
            <div class="mt-5">
                <div class="align-center pt-5">
                    <h2>Oktoberfest</h2>
                    <img src="https://shambhalamusicfestival.com/wp-content/uploads/2019/04/1080x1080_JCRUZ-SMF18-128.jpg" 
                    alt="" class="rounded-circle center-block" style="width:170px;">
                </div>
                <!--  -->
                <!-- Google Map -->
        <div id="map"></div>
        
        <!--  -->
        <script>
      var map;
      var infoWindow;

      function initMap() {
        // Waterloo Region
        var myLatlng = {lat: 43.464, lng: -80.520};

        map = new google.maps.Map(document.getElementById('map'), {
          center: myLatlng,
          disableDefaultUI: true,
          zoom: 10
        });

        setMarkers(map);

        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Oktoberfest');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });

          /*
          // When click move center
          map.addListener('click', function(e) {
            placeMarkerAndPanTo(e.latLng, map);
          });
          */
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      // Data for the markers consisting of a name, a LatLng and a zIndex for the
      // order in which these markers should display on top of each other.
      var festivals = [
        ['Kitchener Waterloo OktoberFest', 43.464, -80.520, 2],
      ];

      function setMarkers(map) {

        var markers = [];
        var infowindows = [];

        for (var i = 0; i < festivals.length; i++) {
          // alert(festivals[i][3]);
          var festival = festivals[i];
          var marker = new google.maps.Marker({
            position: {lat: festival[1], lng: festival[2]},
            map: map,
            title: festival[0],
            zIndex: festival[3]
          });

          // markers.push(marker);

          var contentString = festival[0] + "<br>Lat: " + festival[1] + "<br>" + festival[2]
            + "<br><a href='#' class='btn btn-info'>Detail...</a>";
          infowindow = new google.maps.InfoWindow({
            content: contentString
          });

          // infowindows.push(infowindow);
          marker.addListener('click', function() {
            infowindow.open(map, marker);
          });
          
        }
      }

      // Handle Location Error
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        /*
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
        */
      }
    </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvbWIoBpy3ukwbEVlyVuyQEJAffOpYFaU&callback=initMap"
                async defer></script>
    

        <!-- Google Map End -->

                <div class="group-info field-group-div mt-2 pl-2 pt-2" style="border: 1px solid black">
                    <div class="field field-name-field-location-taxonomize-terms">Kitchener, Ontario, Canada</div>
                    <div class="field field-name-host-verification">      
                        <a href="/frequently-asked-questions#t40266n199875" target="_blank">
                        <div class="verification">
                            <i class="fa fa-check-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="To learn more about ID Verified, please click here."></i>
                            <span class="verify-text"> ID: 123456</span>
                        </div>
                        </a>
                        <br>
                    </div>
                    <div class="field field-name-request-stay-button">
                    </div>
                    <div class="field field-name-profile-leave-a-review">
                        <a href="#" class="btn btn-primary">Leave a Review</a>
                        <br><br>
                        <div style="display:none">
                            <div id="message-container">You cannot leave a review on this member!</div>
                        </div>
                    </div>
                    <div class="field field-name-field-languages-spoken-well">
                        <div class="label-inline">Languages Spoken:&nbsp;
                        </div>
                        English
                    </div>
                    <div class="field field-name-member-since">
                        <span class="member-id">
                            <b>Member ID#: </b> 208460<br>
                        </span>
                        <span class="age">
                        </span>
                        
                        <span class="member-since">
                        <b>Member since: </b>2019<br></span>
                        <span class="member-lastseen">
                        <b>Last Login: </b> Mar 3, 2020<br>
                        <b>Last Updated: </b> Mar 3, 2020<br></span>
                        <hr>
                    </div>
                    <div class="field field-name-response-stats">
                        <span class="response-time">
                            <b>Response Time:</b> within 6 days
                        </span>
                        <br>
                        <span class="response-rate">
                            <a href="/frequently-asked-questions#t40266n195003" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="To learn more about how we calculate response rates, please click here.">
                            <b>Response Rate: </b>
                            </a> 88%
                        </span>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
        <!-- left end -->

        <!-- /.col-lg-5 -->

        <div class="col-lg-9 top-space pt-5 m5-5">
            <div class="mt-5 ">

                <div class="detail-top-img">
                    <img src="https://media.stubhubstatic.com/stubhub-catalog/d_defaultLogo.jpg/t_f-fs-0fv,q_auto:low,f_auto,c_fill,dpr_2.0,$w_750,$h_416/grouping/1498494/b7a1854668a06c4df3f7b23ec783588f" alt="event image">
                </div>
                <ul class="nav nav-tabs mt-3">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#desc">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#job">Job&Volunteer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#accommodation">Accommodation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#summary">Summary</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="desc">
                        <h2>Oktoberfest</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium consequatur, quis numquam alias cupiditate iusto cum facilis ullam quod delectus laboriosam, perspiciatis ratione rerum necessitatibus? Dolorum ipsa reiciendis non repellendus.</p>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ad enim saepe, ipsa dolore assumenda tempora tempore quo iste officia molestias!</p>
                        <h3>Early Bird Special</h3>
                        <button class="btn btn-success">Buy Now</button>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc id ornare libero. Vivamus iaculis, justo vel mattis pharetra, nisi ligula varius nisl, sit amet mollis tortor ligula vitae nisi.</p>
                    </div>
                    <div class="tab-pane fade" id="job">
                        <p>Curabitur dignissim quis nunc vitae laoreet. Etiam ut mattis leo, vel fermentum tellus. Sed sagittis rhoncus venenatis. Quisque commodo consectetur faucibus. Aenean eget ultricies justo.</p>
                        <h3><a>Available opportunities</a> </h3>
                        <h4><a href=""> - Facility Maintenance (Paid)</a> </h4>
                        <h4><a href=""> - Cleaner (Paid)</a></h4>
                        <h4><a href=""> - Info desk (Volunteer)</a></h4>
                    </div>
                    <div class="tab-pane fade" id="accommodation">
                        <p>Curabitur dignissim quis nunc vitae laoreet. Etiam ut mattis leo, vel fermentum tellus. Sed sagittis rhoncus venenatis. Quisque commodo consectetur faucibus. Aenean eget ultricies justo.</p>
                    </div>
                    <div class="tab-pane fade" id="summary">
                        <p>Curabitur dignissim quis nunc vitae laoreet. Etiam ut mattis leo, vel fermentum tellus. Sed sagittis rhoncus venenatis. Quisque commodo consectetur faucibus. Aenean eget ultricies justo.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-7 -->
                               
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
