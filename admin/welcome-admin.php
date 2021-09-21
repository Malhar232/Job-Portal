<?php
    session_start();
    include ('../util/connection.php');
    include ('../util/checkAdmin.php');
    
    ?>  
<style>
    <?php include '../css/charts.css'; ?>
    <?php include '../css/_sidenav.css'; ?>
</style>
<html>
    <head>
        <link rel='icon' href='../images/logo.png'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
        <title>  
            Welcome | Apex
        </title>
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
            include ("../util/connection.php");
            
            
            $get_user_details = "select * from admin WHERE AdminEmail='{$_SESSION['email']}'";
            $q_getUser = mysqli_query($connection, $get_user_details);
            
            if (mysqli_num_rows($q_getUser) == 0)
            {
                echo 'Please Sigin to access this page';
            }
            else
            {
                $row = mysqli_fetch_assoc($q_getUser);
                
                echo "<ul id='slide-out' class='side-nav fixed z-depth-2'>
                    <li class='no-padding'>
            
                      <div class='darken-2 white-text' style='height: 250px;padding-top:20px;  background-color: #7840a1 !important;'>
            
            
                        <div class='row' style='line-height:30px'>
                          <img style='margin-top: 5%;' width='120' height='120' src='../images/icons/user.png' class='circle responsive-img' />
                          <br>
                          <br>
                          <div style='display:flex;align-items:center;justify-content:center'>
                          <p style='margin:0;padding:0;font-weight:bold;font-size:1.1rem;text-align:justify'>
                            <i class='fa fa-user'></i> <span class='tag'>{$row['AdminName']}</span> 
                          </p>
                          </div>
                        </div>
                      </div>
                    </li>
            
                    <li id='dash_dashboard'><a class='waves-effect' href='CollegeDrive.php'>Campus Drive</a></li>
                    <li id='dash_dashboard'><a class='waves-effect' href='jobOffers.php'>Overall Job Applications</a></li>
                    <li id='dash_dashboard'><a class='waves-effect' href='companies.php'>List of Companies</a></li>
                    <li id='dash_dashboard'><a class='waves-effect' href='DriveApplications.php'>Drive Applications</a></li>
                    <li id='dash_dashboard'><a class='waves-effect' href='selectedStudents.php'>List of Selected Students</a></li>
            
            
                </ul>
                ";
            
            }
            
            // echo "<br><a href='CollegeDrive.php'>College Campus Placement Drive</a><br>";
            // echo "<a href='jobOffers.php'>Jobs Applications</a><br>";
            // echo "<a href='companies.php'>List of Companies</a><br>";
            // echo "<a href='selectedStudents.php'>List of Selected Students</a>";
            include ('../util/data.php');
            ?>  
        <header class="head">
            <ul class="dropdown-content" id="user_dropdown" >
                <li><a style="color:#4b0082" class="" href="../util/updateProfile.php">Update Profile</a></li>
                <li><a style="color:#4b0082" class="" href="../util/changePass.php">Change Password</a></li>
                <li><a style="color:#4b0082" class="" href="../util/logout.php">Logout</a></li>
            </ul>
            <nav style="background-color:#4b0082;" role="navigation">
                <div class="nav-wrapper">
                    <a data-activates="slide-out" class="button-collapse show-on-" href="#!"><img src="../images/logo.png" width='65'/></a>
                    <ul class="right">
                        <li>
                            <a class='right dropdown-button' href='' data-activates='user_dropdown'><i class=' material-icons'>account_circle</i></a>
                        </li>
                    </ul>
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                </div>
            </nav>
        </header>
        <section class='main-section'>
            <h3>Welcome, <?=$_SESSION['email']?></h3>
            <div class="wrapper-count">
                <div class="counter col_fourth">
                    <i class="fa fa-users fa-2x"></i>
                    <h2 class="timer count-title count-number" data-to="<?=mysqli_num_rows($q_get_total_students)?>" data-speed="1000"></h2>
                    <p class="count-text ">Total Students Registered</p>
                </div>
                <div class="counter col_fourth">
                    <i class="fa fa-bullseye fa-2x"></i>
                    <h2 class="timer count-title count-number" data-to="<?=mysqli_num_rows($q_get_campus_drives)?>" data-speed="1000"></h2>
                    <p class="count-text ">Active Campus Drives</p>
                </div>
                <div class="counter col_fourth">
                    <i class="fa fa-check-square fa-2x"></i>
                    <h2 class="timer count-title count-number" data-to="<?=mysqli_num_rows($q_get_selected_students)?>" data-speed="1000"></h2>
                    <p class="count-text ">Total Students Selected</p>
                </div>
                <div class="counter col_fourth end">
                    <i class="fa fa fa-building-o fa-2x"></i>
                    <h2 class="timer count-title count-number" data-to="<?=mysqli_num_rows($q_get_companies)?>" data-speed="1000"></h2>
                    <p class="count-text ">Total Companies</p>
                </div>
            </div>
            <script>
                $('.button-collapse').sideNav();
                
                $('.collapsible').collapsible();
                
                $('select').material_select();
            </script>
            <script>
                (function ($) {
                	$.fn.countTo = function (options) {
                		options = options || {};
                		
                		return $(this).each(function () {
                			// set options for current element
                			var settings = $.extend({}, $.fn.countTo.defaults, {
                				from:            $(this).data('from'),
                				to:              $(this).data('to'),
                				speed:           $(this).data('speed'),
                				refreshInterval: $(this).data('refresh-interval'),
                				decimals:        $(this).data('decimals')
                			}, options);
                			
                			// how many times to update the value, and how much to increment the value on each update
                			var loops = Math.ceil(settings.speed / settings.refreshInterval),
                				increment = (settings.to - settings.from) / loops;
                			
                			// references & variables that will change with each update
                			var self = this,
                				$self = $(this),
                				loopCount = 0,
                				value = settings.from,
                				data = $self.data('countTo') || {};
                			
                			$self.data('countTo', data);
                			
                			// if an existing interval can be found, clear it first
                			if (data.interval) {
                				clearInterval(data.interval);
                			}
                			data.interval = setInterval(updateTimer, settings.refreshInterval);
                			
                			// initialize the element with the starting value
                			render(value);
                			
                			function updateTimer() {
                				value += increment;
                				loopCount++;
                				
                				render(value);
                				
                				if (typeof(settings.onUpdate) == 'function') {
                					settings.onUpdate.call(self, value);
                				}
                				
                				if (loopCount >= loops) {
                					// remove the interval
                					$self.removeData('countTo');
                					clearInterval(data.interval);
                					value = settings.to;
                					
                					if (typeof(settings.onComplete) == 'function') {
                						settings.onComplete.call(self, value);
                					}
                				}
                			}
                			
                			function render(value) {
                				var formattedValue = settings.formatter.call(self, value, settings);
                				$self.html(formattedValue);
                			}
                		});
                	};
                	
                	$.fn.countTo.defaults = {
                		from: 0,               // the number the element should start at
                		to: 0,                 // the number the element should end at
                		speed: 1000,           // how long it should take to count between the target numbers
                		refreshInterval: 100,  // how often the element should be updated
                		decimals: 0,           // the number of decimal places to show
                		formatter: formatter,  // handler for formatting the value before rendering
                		onUpdate: null,        // callback method for every time the element is updated
                		onComplete: null       // callback method for when the element finishes updating
                	};
                	
                	function formatter(value, settings) {
                		return value.toFixed(settings.decimals);
                	}
                }(jQuery));
                
                jQuery(function ($) {
                  // custom formatting example
                  $('.count-number').data('countToOptions', {
                	formatter: function (value, options) {
                	  return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
                	}
                  });
                  
                  // start all the timers
                  $('.timer').each(count);  
                  
                  function count(options) {
                	var $this = $(this);
                	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
                	$this.countTo(options);
                  }
                });
                
            </script>
            <div id="analytics">
                <canvas id="myChart" width="100" height="100"></canvas>
                <div class='clrfx'></div>
                <br>
                <canvas id="myChart2" width="400" height="400"></canvas>
            </div>
            <script>
                var ctx = document.getElementById('myChart');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data : {
                    labels: [
                      'Registered students on this platform ',
                        'YCCE',
                        'RCOEM',
                        'VNIT',
                        'Raisoni'
                    ],
                  datasets: [{
                    label: 'My First Dataset',
                    data: [0,<?=mysqli_num_rows($q_get_total_ycce_students)?>,<?=mysqli_num_rows($q_get_total_rcoem_students)?>,<?=mysqli_num_rows($q_get_total_vnit_students)?>,<?=mysqli_num_rows($q_get_total_raisoni_students)?>],
                    backgroundColor: [
                      'transparent',
                      'rgb(255, 99, 132)',
                      'rgb(54, 162, 235)',
                      'rgb(255, 205, 86)',
                      '#2ecc71',
                    ],
                    hoverOffset: 4
                  }],
                }
                });
                
                var ctx2 = document.getElementById('myChart2');
                var myChart = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: ['YCCE', 'RCOEM', 'VNIT', 'Raisoni'],
                        datasets: [{
                            label: '% of Students Selected',
                            data: [<?=$percentage_YCCE?>, <?=$percentage_RCOEM?>, <?=$percentage_VNIT?>, <?=$percentage_Raisoni?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </section>
    </body>
</html>