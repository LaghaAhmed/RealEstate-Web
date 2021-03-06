<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Mes annonces</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script type="text/javascript" src="js/fonction.js"></script>

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">

   <?php 	
            include_once("inc/connexion.php"); 
            include_once("inc/fonction.php"); 

            ?>
  </head>
<!--**********************************************************BODY***************************************************************-->
  
  <body style='margin: auto;max-width: 1500px;min-width: 980px;width:80%'>

            <?php 
            include_once("inc/head.php"); 
            include_once("inc/gauche.php");

            if(isset($_SESSION['idannonce'])){
            $req="UPDATE `annonce` SET `verif`='0' WHERE `id`='".$_SESSION['idannonce']."'";
            $res = mysql_query($req) or die('Erreur SQL !<br />'.$req.'<br />'.mysql_error());
            $_SESSION['idannonce']='0';
            };
                   $login=$_SESSION['login']; 
                   $idannonceur=$_SESSION['id']; 

                                   
              ?>

        <div class="span9">
          <div class="hero-unit" style=' height:90%;min-height:680px;'> 
            <h1><u>Mes annonces</u></h1> <br>

           

            <form name="r" method="post" enctype="multipart/form-data" action="index.php" >
            	   
                <table cellpadding=4>

                <?php 

                $res = "SELECT * FROM `annonce` WHERE `verif`!='2' AND `annonceur`='".$login."' ORDER BY `date` DESC" ;
                $req = mysql_query($res) or die('Erreur SQL !<br />'.$res.'<br />'.mysql_error());
                while($row = mysql_fetch_array($req)){

                   $idannonce=$row['id'];
                   $offre=$row['offre'];
                   $type=$row['type'];
                   $annonceur=$row['annonceur'];
                   $pays=$row['pays'];
                   $region=$row['region'];
                   $departement=$row['departement'];
                   $prix=$row['prix'];
                   $surface=$row['surface'];
                   $description=$row['description'];
                   $image=$row['image'];
                   $video=$row['video'];
                   $adresse=$row['adresse'];
                   $detail=$row['detail'];
                   $date=$row['date'];
                   $verif=$row['verif'];
                   $nbrvote=$row['nbrvote'];

                     $req2 = "SELECT `image` FROM `image` WHERE `num-annonce`=".$idannonce ;
                    $res2 = mysql_query($req2) or die('Erreur SQL !<br />'.$req2.'<br />'.mysql_error());
                    $row2 = mysql_fetch_array($res2);

                    
                    if($verif=='0'){ echo '<tr><td><h3 style="font-family:helvetica neue;font-size: 1em;font-weight: 400;color:#7d7d7d">Annonce en cours de traitement...</h3></td></tr>' ;}
                   
                    echo '<tr style="border-bottom-style:groove;" id="div'.$idannonce.'"><td>

                    <table name="annonce" style="width:100%">

                    <tr valign="top">
                    <td rowspan="5" width="153"><a href="annonce.php?id='.$idannonce.'"><img src="img/upload/'.$row2['image'].'"  width="150" height="150" style="padding:2px;"></a></td>
                    <td><h3 style="display:inline-block"><u>'.'-'.$offre.' à ' ;
                        if ($type==1){echo 'vendre';}
                        elseif ($type==2){ echo 'louer';}
                        else {echo 'vendre ou à louer';};
                        echo '</u></h3><p> à '.$prix.'€</p>
                    </td>
                    <td rowspan="5" width="5%"><a href="#">Modifier</a><br><a href="#" onclick="supp('.$idannonce.')">supprimer</a></td></tr>';
                        echo '<tr><td>Adresse : '.$adresse.'</td></tr>';
                        echo '<tr><td>Description : '.$description.'</td></tr>';
                        echo '<tr><td>';
                        if (isset($detail)){
                        echo '<table><tr><td rowspan="6">'.$detail[0].' chambre(s) avec :    </td>';
                          if ($detail[1]){ echo '<tr><td> Picine</td></tr>';}
                          if ($detail[2]){ echo '<tr><td> Garage </td></tr>';}
                          if ($detail[3]){ echo '<tr><td> Jardin </td></tr>';}
                          if ($detail[4]){ echo '<tr><td> Cave </td></tr>';}
                          if ($detail[5]){ echo '<tr><td> Cheminée </td></tr>';}
                          if ($detail[6]){ echo '<tr><td> Terrasse </td></tr>';}
                        }

                        echo'</table></td></tr><tr><td><h6>Déposée le: '.$date.'</h6></td></tr></table></td></tr>';
                }; 
                ?>
                </table>





          </form>
      </div>
    </div>
    </body>
  </div>
</div>

<?php
aff($_SESSION);          
include_once('inc/footer.html')
?>