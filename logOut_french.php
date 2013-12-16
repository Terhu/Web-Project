<?php

	$name=$_COOKIE['LastName'];

	// si on appui sur "anglais", on va sur l'index anglais
    if(isset($_POST['english']))
    {
        setcookie('lang', "english", time()+3600);
        header("location: logOut_english.php");
    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <title> Page de D&eacute;connection </title>  
    <link type="text/css" rel="stylesheet" href="mystyle.css" />  
</head> 



        <!-- Liste des choix de langues -->
        <div id="colonne1" class="panel panel-info" id="lg_choice"> 
            <div class="panel-heading">Choix des langues</div>
              <div class="panel-body">
                    <form class="form-signin" role="form" action="logOut_french.php" method="post">
                        <h2 class="form-signin-heading">  </h2>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="francais" id="francais">Fran&ccedil;ais</button>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="english" id="english">English</button>
                    </form>
              </div>
            </div> 
        </div> 

<div id="centre">
		<div id="loginform" class="container"> 

		        <h2 class="form-signin-heading"> <?php echo htmlentities("Êtes-vous sûr de vouloir partir ?") ?> </h2>

			<form class="form-signin" role="form" method="post" action="logOut2.php">
				<input class="btn btn-primary btn-block" type="submit" name="yeah" id="yeah" value="Oui">
			</form>
			<form method="post" action="chat_french.php">
				<input class="btn btn-default btn-block" type="submit" name="nope" id="nope" value="Non">
			</form>
		</div> 
</div> 

</html>


