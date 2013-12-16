<?php

	$name=$_COOKIE['LastName'];

	//if the user press the button "francais", we change page for "index.php"
    if(isset($_POST['francais']))
    {
        setcookie('lang', "french", time()+3600);
        header("location: logOut_french.php");
    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <title> Log Out Page </title>  
    <link type="text/css" rel="stylesheet" href="mystyle.css" />  
</head> 


        <!-- Displays the languages choices -->
        <div id="colonne1" class="panel panel-info" id="lg_choice"> 
            <div class="panel-heading">Language Choice</div>
              <div class="panel-body">
                    <form class="form-signin" role="form" action="logOut_english.php" method="post">
                        <h2 class="form-signin-heading">  </h2>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="francais" id="francais">Fran&ccedil;ais</button>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="english" id="english">English</button>
                    </form>
              </div>
            </div> 
        </div> 

<div id="centre">
		<div id="loginform" class="container"> 

		        <h2 class="form-signin-heading"> <?php echo htmlentities("Are you sure you want to leave the chat ?") ?> </h2>

			<form class="form-signin" role="form" method="post" action="logOut2.php">
				<input class="btn btn-primary btn-block" type="submit" name="yeah" id="yeah" value="yeah">
			</form>
			<form method="post" action="chat_english.php">
				<input class="btn btn-default btn-block" type="submit" name="nope" id="nope" value="nope">
			</form>
		</div> 
</div> 

</html>


