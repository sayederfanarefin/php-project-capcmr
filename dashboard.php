<?php
    session_start();
    $user_email;
    $user_name;

    $errorpafelocation = 'Location: error_page.php?err_msg=';
    include 'db_connection.php';

    if (isset($_SESSION['user'])) {
        // logged in
        $user_email = $_SESSION['user'];
        $query2 = 'SELECT user_name FROM users WHERE user_email="'.$user_email.'"';
        $result2 = mysqli_query($conn,$query2);
        

        if($result2 == NULL){
             $user_name = $user_email;
        }else{
           $row2 = $result2->fetch_assoc();
            $user_name = $row2["user_name"];
        }
    } else {
        // not logged in
        //header ('Location : /index.php');
        header($errorpafelocation."You are not siggned in. Please sign in/sign up.&err_bttn=Sign up / Sign in&err_bttn_link=signin.html" );
     }
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
<meta name="google-site-verification" content="UFatjX4oHvkXpql51lWegKkjae2l--TZRpzo_PwnJI4" />
    <meta name="Neonsofts" content="http://www.neonsofts.com">
    <title>CAPCMR</title>
    <!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">

    <link href="css/animate.min.css" rel="stylesheet"> 
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet"> 
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/icon/favicon.ico"> 
</head> 

<body id="home">

    <header id="header">
        <nav id="main-nav" class="navbar navbar-default navbar-fixed-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <h2>Welcome <?php echo $user_name; ?></h2>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="signout.php">Sign out</a></li>
                                             
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
    </header><!--/header-->

<br><br>
<div class="container">
    <div class="row">

     <form role="form" id="assign_teacher_form_666" action="/php-files/assign_teacher_semester.php" method="post">


        <div class="col-sm-3">
           
            <div class="form-group">
                <label> Select Company Type</label>
                <select class="form-control" id="Dept" name="Dept">
                   <?php 

                    $query = 'SELECT DISTINCT(company_type) FROM companies';
                    $result = mysqli_query($conn,$query);
                    while ($row = $result->fetch_assoc()) {
                        $company_types = $row["company_type"];
                        echo "<option>".$company_types."</option>";

                     }
                     
                    
                    ?>
                </select>
           </div> 

        </div>




        <div class="col-sm-3">
            <div class="form-group">
                <label> Select Available Companies</label>
                <select class="form-control"  id="existing_courses_show_bla" name="existing_courses_show_bla" required>
                                 
                                
                </select>
            </div>

        </div>





        <div class="col-sm-3">
             <div class="form-group">
                <label> Select Available Company Data  Type</label>
                <select class="form-control"  id="existing_courses_show_bla_2" name="existing_courses_show_bla_2" required>
                                 
                                
                </select>
            </div>

        </div>


        <div class="col-sm-3">
            <div class="form-group">
                <label> Select An Available Year</label>
                <select class="form-control"  id="existing_courses_show_bla_3" name="existing_courses_show_bla_3" required>
                                 
                                
                </select>
            </div>
        </div>

         </form>
    </div>
</div>

    <br>
<!-- Here starts the mighty footer-->
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2016 CAPCMR. Developed by <a target="_blank" href="http://www.neonsofts.com">Neonsofts</a><br>
                </div>
                <div class="col-sm-6">
                    <ul class="social-icons">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/mousescroll.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/jquery.inview.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/custom-scripts.js"></script>


<!--for the available company portion-->
    <script>

        $('#Dept').on('change', function () {
            var e = document.getElementById("Dept");
            var Dept_val = e.options[e.selectedIndex].value;

            $.ajax({
                url: "get_company_by_type.php",
                type: "POST",
                data: { 'Dept': Dept_val },
                success: function (dataa) {
                    $('#existing_courses_show_bla').html('');
                    data = JSON.parse(dataa);
                    lengtio = data.length;
                    for (i = 0; i < lengtio; i++) { 
                    $('#existing_courses_show_bla').append('<option>'+data[i]+'</option>');
                        
                    }
                },
                error: function () {
                    alert("Sorry something went wrong, please try again!");
                }
            });
        });

    </script>

<!-- for the company data type -->
  <script>

        $('#existing_courses_show_bla').on('change', function () {
            var e = document.getElementById("existing_courses_show_bla");
            var Dept_val = e.options[e.selectedIndex].value;

            $.ajax({
                url: "get_data_type_by_company.php",
                type: "POST",
                data: { 'Dept': Dept_val },
                success: function (dataa) {
                    $('#existing_courses_show_bla_2').html('');
                    data = JSON.parse(dataa);
                    lengtio = data.length;
                    for (i = 0; i < lengtio; i++) { 
                    $('#existing_courses_show_bla_2').append('<option>'+data[i]+'</option>');
                        
                    }
                    
                },
                error: function () {
                    alert("Sorry something went wrong, please try again!");
                }
            });
        });

    </script>

<!-- year portion -->
  <script>

        $('#existing_courses_show_bla_2').on('change', function () {
            var e = document.getElementById("existing_courses_show_bla_2");
            var Dept_val = e.options[e.selectedIndex].value;


            var e2 = document.getElementById("existing_courses_show_bla");
            var Dept_val_2 = e2.options[e2.selectedIndex].value;


            $.ajax({ 
                url: "get_year_by_company_data_type.php",
                type: "POST",
                data: { 'Dept': Dept_val , 'company': Dept_val_2 },
                success: function (dataa) {
                    $('#existing_courses_show_bla_3').html('');
                    data = JSON.parse(dataa);
                    lengtio = data.length;
                    for (i = 0; i < lengtio; i++) { 
                    $('#existing_courses_show_bla_3').append('<option>'+data[i]+'</option>');
                        
                    }
                    
                },
                error: function () {
                    alert("Sorry something went wrong, please try again!");
                }
            });
        });

    </script>



     <script>
        //by default load something in the dropdown
        $( document ).ready(function() {
               


                var e = document.getElementById("Dept");
                var Dept_val = e.options[e.selectedIndex].value;

                $.ajax({
                    url: "get_company_by_type.php",
                    type: "POST",
                    data: { 'Dept': Dept_val },
                    success: function (dataa) {
                        $('#existing_courses_show_bla').html('');
                        data = JSON.parse(dataa);
                        lengtio = data.length;
                        for (i = 0; i < lengtio; i++) { 
                        $('#existing_courses_show_bla').append('<option>'+data[i]+'</option>');
                            
                        }




            var e = document.getElementById("existing_courses_show_bla");
            var Dept_val = e.options[e.selectedIndex].value;

            $.ajax({
                url: "get_data_type_by_company.php",
                type: "POST",
                data: { 'Dept': Dept_val },
                success: function (dataa) {
                    $('#existing_courses_show_bla_2').html('');
                    data = JSON.parse(dataa);
                    lengtio = data.length;
                    for (i = 0; i < lengtio; i++) { 
                    $('#existing_courses_show_bla_2').append('<option>'+data[i]+'</option>');
                        
                    }
                    
                },
                error: function () {
                    alert("Sorry something went wrong, please try again!");
                }
            });







                        
                    },
                    error: function () {
                        alert("Sorry something went wrong, please try again!");
                    }
                });



        });        
        </script>
   
</body>
</html>