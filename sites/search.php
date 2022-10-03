<?php
	session_start();
    require 'connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title>CIVIL Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
		
		<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>PHP Live MySQL Database Search</title>
<style type="text/css">
body{font-family: Arail, sans-serif;}
.search-box{width:100%;margin-top: 10%;display: inline-block;position: relative;}
.result{width:35%;font-size:17px;margin-left:-5%;}
 .result p{text-align:left;margin: 0;padding: 5px 10px;border: 1px solid #CCCCCC;border-top: none;cursor: pointer;}
.result p:hover{background: #f2f2f2;}
.example input[type="text"]{height:50px;width:35%;font-size:17px;padding: 5px 10px;border: 2px solid grey;}
.example button{width:70px;height:50px;margin-left:-0.3%;border: 2px solid grey;}
form.example button:hover {background: #0b7dda;}
form.example::after {content: "";clear: both;display: table;}
@media screen and (max-width: 600px) {
.search-box{width:100%;margin-top: 15%;}
.example input[type="text"]{height:40px;width:50%;font-size:17px;}
.example button{width:50px;height:40px;margin-left:-0.9%;}
.result{width:50%;font-size:17px;margin-left:-10%;}
}
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
		$('.search-box input[type="text"]').click(function(e){
    $(".result").show();
     e.stopPropagation();  
	});

	$(".result").click(function(e){
    e.stopPropagation();
	});

	$(document).click(function(){
    $(".result").hide();
	});
});
</script>
		
    </head>
    <body>
        <div>
            <?php
                require 'header.php';
            ?>
            <br><br><br>
				<div class="search-box"><center>
					<form class="example" method="get" action="search_result.php">
						<input type="text" name="search" autocomplete="off" placeholder="Search Products..." required>
						<button type="submit"><i class="fa fa-search"></i></button>
						<div class="result"></div>
					</form></center>
				</div>
		   
           <br><br><br><br><br>
           <footer class="footer">
               <div class="container">
                <center>
                   <p>Copyright &copy CIVIL Store. All Rights Reserved.</p>
                   <p>This website is developed by CodeNation</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>
