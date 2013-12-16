<?php

    include("functions.php");
    session_start();

    // initialisation de la variable error pour l'affichage des alertes pseudo
    $error=0;

    /* Test pour voir si le pseudo rentre par l'utilisateur est utilisable ou pas */ 
    if(isset($_POST['enter']))
    {  
        //si l'utilisateur a rentre un pseudo
        if($_POST['name'] != "")
        {  
            //on verifie que les characteres rentrés sont autorises (chiffres et/ou lettres)
            if(ctype_alnum($_POST['name']))
            {
                //on verifie qu'il n'est pas encore utilise
                    //si il n'est pas encore utilise, on va dans le chatRoom
                if(user_search($_POST['name'])==0)
                {
                    $error=0;
                    $name = stripslashes(htmlspecialchars($_POST['name']));
                    setcookie('LastName', $name, time()+3600);
                    $_SESSION['name'] = $name;  
                    // on est redirrige vers la sallle de chat en francais
                    header("location: chat_french.php") ;
                }
                else  //sinon il est deja utilise et on lui en demande un autre
                {
                    $error=1;
                }
            }
            else  // sinon l'utilisateur a utilise des characteres interdits, 
                //on le lui signal et on lui demande un autre pseudo
            {
                $error=3;
            }
        }  
        else // sinon l'utilisateur n'a pas rentre de pseudo, 
            // on le lui signal et on lui redemande un pseudo
        {  
            $error=2;
        	$_SESSION['name'] = "idiot";
        }  
    }  

    // si la langue est deja definie,
        // soit la langue est anglais donc on change page
        // soit la langue est francais, donc on reste sur cette page
    if(isset($_COOKIE['lang']))
    {
        if($_COOKIE['lang'] == "english")
        {
            header("location: index_english.php");
        }
    }
    else
    {
        setcookie('lang', "french", time()+3600);
        //header("location: index.php");
    }

    // si on appui sur "anglais", on va sur l'index anglais
    if(isset($_POST['english']))
    {
        setcookie('lang', "english", time()+3600);
        header("location: index_english.php");
    }

?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
    <head>  
        <title>Accueil Chat</title>  
        <link type="text/css" rel="stylesheet" href="mystyle.css" />  
    </head> 

        <!-- Liste des choix de langues -->
        <div id="colonne1" class="panel panel-info" id="lg_choice"> 
            <div class="panel-heading">Choix des langues</div>
              <div class="panel-body">
                    <form class="form-signin" role="form" action="index.php" method="post">
                        <h2 class="form-signin-heading">  </h2>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="francais" id="francais">Fran&ccedil;ais</button>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="english" id="english">English</button>
                    </form>
              </div>
            </div> 
        </div> 


    <!-- Formulaire d'inscription -->
    <div id="centre">
        <div id="loginform" class="container"> 

            <form class="form-signin" role="form" action="index.php" method="post">
                <h2 class="form-signin-heading"> Bienvenu sur le ZZchat! </h2>

                <input type="text" class="form-control" 
                        placeholder="Pseudo" required="" autofocus="" 
                            name="name" id="name" value="<?php if(isset($_COOKIE['LastName'])) 
                                                                { 
                                                                    echo $_COOKIE['LastName']; 
                                                                } ?>">
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="enter" id="enter">Enregistrement</button>
              </form>
        </div> 
    </div> 

    <br>
    <br>
    <br>

    <!-- Affichage des messages d'erreur -->
    <div>
        <?php 
        if($error==1)
        { ?>
            <div id="infopseudo">
                <a href="#" >
                    <strong>Le pseudo existe d&eacute;j&agrave;:</strong>  veuillez en rentrer un autre SVP :)
                </a>
            </div>
        <?php
        }
        if($error==2)
        {  ?>
            <div id="infopseudo">
                <a href="#" >
                   <strong> Veuillez rentrer un pseudo </strong>
                </a>
            </div>
        <?php
        }
        if($error==3)
        {  ?>
            <div id="infopseudo">
                <a href="#" >
                   <strong> Veuillez rentrer un pseudo ne comportant que des chiffres et/ou des lettres SVP </strong>
                </a>
            </div>
        <?php
        }
        ?>
    </div>

</html>


