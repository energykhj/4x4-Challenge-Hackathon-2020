@extends('layouts.app')
<style>
  /* Always set the map height explicitly to define the size of the div
    * element that contains the map. */
  #map {
    height: 60%;
  }
  /* Optional: Makes the sample page fill the window. */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
</style>

    <div class="col-12" style="margin-top:110px;">
        <section class="search-sec">
            <div class="container">
                <form action="#" method="post" novalidate="novalidate">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 p-1">
                                    <input type="text" class="form-control search-slt border border-danger" placeholder="Enter Festival">
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-12 p-1">
                                    <input type="text" class="form-control search-slt border border-danger" placeholder="Enter City or ZipCode">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 p-1">
                                    <input type="date" class="form-control search-slt border border-danger" placeholder="Base date">
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-12 p-1">
                                    <select class="form-control search-slt border border-danger" id="exampleFormControlSelect1">
                                        <option>( Select Option )</option>
                                        <option>All</option>
                                        <option>Volunteer</option>
                                        <option>Paid job</option>
                                        <option>Accommodation</option>
                                        <option>Festival</option>
                                        <option>Accessibility</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-12 p-1">
                                    <button type="button" class="btn btn-danger wrn-btn">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-5 p-3">
          <div class="map mt-1">
            <!-- Google Map -->
            <div id="map"></div>
            
      <!-- Google map script -->
      <script>
        var map;
        var infoWindow;

        function initMap() {
          // Waterloo Region
          var myLatlng = {lat: 43.464, lng: -80.520};

          map = new google.maps.Map(document.getElementById('map'), {
            center: myLatlng,
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
              infoWindow.setContent('You are here.');
              infoWindow.open(map);
              map.setCenter(pos);
            }, function() {
              handleLocationError(true, infoWindow, map.getCenter());
            });
          } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
          }
        }

        // Data for the markers consisting of a name, a LatLng and a zIndex for the
        // order in which these markers should display on top of each other.
        var festivals = [
          ['Kitchener Waterloo OktoberFest', 43.464, -80.520, 2],
          ['Ottawa Children’s Festival', 45.417265, -75.716953, 1],
          ['Canadian Tulip Festival', 45.398717, -75.703414, 1]
        ];

        var markers = [];
        var infowindows = [];

        // Declare variables
        for (var i = 0; i < festivals.length; i++) {
          eval("var marker" + i + ";");
          eval("var infowindow" + i + ";");
        }

        function setMarkers(map) {

          for (var i = 0; i < festivals.length; i++) {
            // alert(festivals[i][3]);
            var festival = festivals[i];

            eval("marker" + i + " = new google.maps.Marker({ position: {lat: festival[1], lng: festival[2]}, map: map, title: festival[0], zIndex: festival[3]  });");
            
            var contentString = festival[0] + "<br>"+"<br>"+
              "<img src= \"/svg/bed2.png\" style=\"height:25px;\" class=\"pr-2\" >"+
              "<img src= \"/svg/meal2.png\" style=\"height:25px;\" class=\"pr-2\">"+
              "<img src= \"/svg/long2.png\" style=\"height:25px;\" class=\"pr-2\">"+
              "<br>";

            eval("infowindow" + i + " = new google.maps.InfoWindow({ content: contentString });");

            // infowindows.push(infowindow);
            // eval("marker" + i + ".addListener('click', function() { infowindow" + i + ".open(map, marker" + i + "); });");
            eval("marker" + i + ".addListener('mouseover', function() { infowindow" + i + ".open(map, marker" + i + "); });");

            eval("marker" + i + ".addListener('mouseout', function() { infowindow" + i + ".close(); });");

          }
        }

        // Set center position
        function setCenter(idx) {
          // Move center
          var pos = {
            lat: festivals[idx][1],
            lng: festivals[idx][2]
          };
          map.setCenter(pos);

          // Show infowindow
          eval("infowindow" + idx + ".open(map, marker" + idx + ");");
        }

        // Close all infowindow
        function closeAllInfowindow() {
          for (var i = 0; i < festivals.length; i++) {
            eval("infowindow" + i + ".close();");
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
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvbWIoBpy3ukwbEVlyVuyQEJAffOpYFaU&callback=initMap">
        </script>
        <!-- Google Map End -->

          </div>   
        </div>
        
            <div class="col-7 pt-3">
                <!-- right side -->
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border border-secondary" onmouseover="setCenter(0);" onmouseout="closeAllInfowindow();">
                            <a href="/detail">
                                <img class="card-img-top mx-auto d-block" src="/svg/images1.jpg" height="150px"></a>
                            <div class="card-body pt-2">
                                <h4 class="card-title">
                                    <a href="/detail" class="text-danger">Oktoberfest</a>
                                </h4>
                                <div class="d-flex">
                                    <div><img src= "/svg/bed2.png" style="height:25px;" class="pr-2 img-fluid" alt="accommodation" title="accommodation"></div>
                                    <div><img src= "/svg/meal2.png" style="height:25px;" class="pr-2" alt="meal" title="meal"></div>
                                    <div><img src= "/svg/long2.png" style="height:25px;" class="pr-2" alt="long period" title="long period"></div>
                                    <div><img src= "/svg/dol.png" style="height:25px;" class="pr-2" alt="paid job" title="paid job"></div>
                                    <div><img src= "/svg/vol1.png" style="height:25px;" class="pr-2" alt="volunteer" title="volunteer"></div>
                                    <div><img src= "/svg/disability1.png" style="height:30px;" class="pr-2" alt="accessibility" title="accessibility"></div>
                                </div>
                                <div>
                                    <div class="pr-5"><strong>Date: </strong> 
                                    <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Kitchener Waterloo OktoberFest&dates=20201009T090000/20201009T200000&ctz=&details=Kitchener Waterloo OktoberFest&location=Kitchener Waterloo">October 9-17 2020</a>
                                    </div>
                                    <div class="pr-5"><strong>Address: </strong> 17 Benton St, Kitchener, ON N2G 3G9</div>
                                    <div class="pr-5"><strong>Celebrations: </strong>Parades, food, music</div>
                                </div>

                                <p class="card-text pt-2">Oktoberfest is the world's largest Volksfest.
                                    Held annually in Munich, Bavaria, Germany, it is a 16- to 18-day folk festival running
                                    from mid or late September to the first Sunday in October,
                                    with more than six million people from around the world attending ... <a href="#">learn more</a></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9734; &#9734; <a href="#"><span class="text-danger pl-3">328 ratings</span></a></small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border border-secondary" onmouseover="setCenter(1);" onmouseout="closeAllInfowindow();">
                            <a href="/detail">
                                <img class="card-img-top mx-auto d-block" src="/svg/images2.jpg" height="150px"></a>
                            <div class="card-body pt-2">
                                <h4 class="card-title">
                                    <a href="/detail" class="text-danger">Ottawa Children’s Festival</a>
                                </h4>
                                <div class="d-flex">
                                    <div><img src= "/svg/bed2.png" style="height:25px;" class="pr-2" alt="accommodation" title="accommodation"></div>
                                    <div><img src= "/svg/meal2.png" style="height:25px;" class="pr-2" alt="meal" title="meal"></div>
                                    <div><img src= "/svg/long2.png" style="height:25px;" class="pr-2" alt="long period" title="long period"></div>
                                    <div><img src= "/svg/vol1.png" style="height:25px;" class="pr-2" alt="volunteer" title="volunteer"></div>
                                    <div><img src= "/svg/disability1.png" style="height:30px;" class="pr-2"></div>
                                </div>
                                <div>
                                    <div class="pr-5"><strong>Date: </strong>
                                    <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Ottawa Children’s Festival&dates=20200509T090000/20200509T200000&ctz=&details=Ottawa Children’s Festival&location=Ottawa">May 6 ~ 10, 2020</a>
                                    </div>
                                    <div class="pr-5"><strong>Time: </strong>8:45 a.m. ~ 4:00 p.m.</div>
                                    <div class="pr-5"><strong>Address: </strong>294 Albert St, Ottawa, ON</div>
                                </div>
                                <p class="card-text pt-2">Since 1985, the Ottawa Children’s Festival (OCF) has hosted
                                    an annual celebration of the best in live performing arts for children.
                                    Creating programs for children aged two to 15, the Festival focuses
                                    strives to present ... <a href="#">learn more</a></p></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734; <a href="#"><span class="text-danger pl-3">124 ratings</span></a></small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border border-secondary" onmouseover="setCenter(2);" onmouseout="closeAllInfowindow();">
                            <a href="/detail">
                                <img class="card-img-top mx-auto d-block" src="/svg/images3.jpg" height="150px"></a>
                            <div class="card-body pt-2">
                                <h4 class="card-title">
                                    <a href="/detail" class="text-danger">Canadian Tulip Festival 2020</a>
                                </h4>
                                <div class="d-flex">
                                    <div><img src= "/svg/long2.png" style="height:25px;" class="pr-2" alt="long period" title="volunteer"></div>
                                    <div><img src= "/svg/dol.png" style="height:25px;" class="pr-2"></div>
                                    <div><img src= "/svg/disability1.png" style="height:30px;" class="pr-2"></div>
                                </div>
                                <div>
                                    <div class="pr-5"><strong>Date: </strong>
                                    <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Canadian Tulip Festival&dates=20200509T090000/20200509T200000&ctz=&details=Canadian Tulip Festival&location=Ottawa">May 8 ~ 18, 2020</a>
                                    </div>
                                    <div class="pr-5"><strong>Time: </strong>8:45 a.m. ~ 4:00 p.m.</div>
                                    <div class="pr-5"><strong>Address: </strong>Commissioners Park</div>
                                </div>
                                <p class="card-text pt-2">The Canadian Tulip Festival started in 1952, and since it is continually held in Ottawa the capital of Canada.
                                    Thousands of Tulip flowers are spread everywhere over the city during the festival.. ... <a href="#">learn more</a></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734; <a href="#"><span class="text-danger pl-3">78 ratings</span></a></small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="/detail">
                                <img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="/detail">Event Four</a>
                                </h4>
                                <h5>$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Amet numquam aspernatur!</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="/detail">
                                <img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="/detail">Event Five</a>
                                </h4>
                                <h5>$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="/detail">
                                <img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="/detail">Event Six</a>
                                </h4>
                                <h5>$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Amet numquam aspernatur!</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- right side -->
            </div>
            <div class="row pt-5">

            </div>
        </div>
    </div>
