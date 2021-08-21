
<!DOCTYPE>
<html>
<?php require 'dbconfig.php';
session_start(); ?>
<head>
<title>COVID ASSESSMENT</title>
<style>
body {
    background: url("bg.png");
	background-size:100%;
	background-repeat: no-repeat;
	position: relative;
	background-attachment: fixed;
}
/* button */
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 500px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}
 
.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}
 
.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}
 
.button:hover span {
  padding-right: 25px;
}
 
.button:hover span:after {
  opacity: 1;
  right: 0;
}
.title{
	background-color: #E82424;
	font-size: 28px;
  padding: 20px;
	
}
.button3 {
    border: none;
    color: white;
    padding: 10px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}
.button3 {
    background-color: white; 
    color: black; 
    border: 2px solid #f4e542;
}
 
.button3:hover {
    background-color: #E54949;
    color: Black;
}
</style>
</head>
<body><center>
<div class="title">Answer the questions carefully and accurately.</div>
<a href="index.php">Home</a></li>
<?php                               
                                if (isset($_POST['click']) || isset($_GET['start'])) {
                                @$_SESSION['clicks'] += 1 ;
                                $c = $_SESSION['clicks'];
                                if(isset($_POST['userans'])) { $userselected = $_POST['userans'];
                                
                                $fetchqry2 = "UPDATE `quiz` SET `userans`='$userselected' WHERE `id`=$c-1"; 
                                $result2 = mysqli_query($con,$fetchqry2);
                                }
      
                                  
                                } else {
                                  $_SESSION['clicks'] = 0;
                                }
                                
                                //echo($_SESSION['clicks']);
                                ?>
<div class="bump"><br><form><?php if($_SESSION['clicks']==0){ ?> <button class="button" name="start" float="left"><span>START QUIZ</span></button> <?php } ?></form></div>
<form action="" method="post">          
<table><?php if(isset($c)) {   $fetchqry = "SELECT * FROM `quiz` where id='$c'"; 
        $result=mysqli_query($con,$fetchqry);
        $num=mysqli_num_rows($result);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC); }
      ?>
<tr><td><h3><br><?php echo @$row['que'];?></h3></td></tr> <?php if($_SESSION['clicks'] > 0 && $_SESSION['clicks'] < 6){ ?>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option 1'];?>">&nbsp;<?php echo $row['option 1']; ?><br>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option 2'];?>">&nbsp;<?php echo $row['option 2'];?></td></tr>
  <tr><td><input required type="radio" name="userans" value="<?php echo $row['option 3'];?>">&nbsp;<?php echo $row['option 3']; ?></td></tr><br><br><br>
  <tr><td><button class="button3" name="click" >Next</button></td></tr> <?php }  
                                  ?> 
  <form>
 <?php if($_SESSION['clicks']>5){ 
  $qry3 = "SELECT `ans`, `userans` FROM `quiz`;";
  $result3 = mysqli_query($con,$qry3);
  $storeArray = Array();
  while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
     if($row3['ans']==$row3['userans']){
     @$_SESSION['score'] += 1 ;
   }
}
 
 ?> 
 
 

 <?php  $no = @$_SESSION['score']; 
 session_unset(); 
 if($no =="1"){
  ?>
  <h1>There is nothing to worry about. You can for your own safety,</h1>
    <ul>
      <li>Stay at home.</li>
      <li>Avoid having any sort of contact with anyone outside</li>
      <li>Wear a mask.</li>
      <li> Get Vaccinated.</li>
      <li>Maintain a safe distance from anyone who is coughing or sneezing.</li>
    </ul>
  </p>
  <h1>To know more,
  <a href="1.html">Click here</a></h1>
  <p>Or go back to home page.</p><?php
 }
 else if($no=="2"){?>
  <h1>It is recommended for you to still go for COVID test. Also,</h1>
    <ul>
      <li>Stay at home.</li>
      <li>Avoid having any sort of contact with anyone outside</li>
      <li>Always Wear a mask.</li>
      <li> Get Vaccinated.</li>
      <li>Maintain a safe distance from anyone who is coughing or sneezing.</li>
    </ul>
    <h1>To know more,
  <a href="2.html">Click here</a></h1><?php
 }
 if($no >"3"){?>
<h1>You should definitely go for RTPCR test as you have encountered scenerios that may give you COVID</h1>
<p>Stay home and self-isolate even if you have minor symptoms such as cough, headache, mild fever, until you recover. Call your health care provider or hotline for advice. Have someone bring you supplies. If you need to leave your house or have someone near you, wear a medical mask to avoid infecting others.</p>
  <h1>To know more,<a href="3.html">Click here</a></h1><?php
 } ?>

<?php } ?>
 <!-- <script type="text/javascript">
    function radioValidation(){
    /* var useransj = document.getElementById('rd').value;
        //document.cookie = "username = " + userans;
    alert(useransj); */
    var uans = document.getElementsByName('userans');
    var tok;
    for(var i = 0; i < uans.length; i++){
      if(uans[i].checked){
        tok = uans[i].value;
        alert(tok);
      }
    }
    }
</script> -->
</center>
</body>