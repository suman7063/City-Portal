<?php
//comment post area
include'db.php';
if(isset($_POST['sub']))
{
    $textarea=$_POST['text'];
    $name=$_POST['user'];
    if($textarea=='')
    {
      echo'<font color="red">Please insert Comment</font>';
    }
    if($name=='')
    {
      echo'<font color="red">Please insert Name</font>';
    }
    else
    {
    $query = "insert into city_portal(text_area,user_name) values('$textarea','$name')";
    if(!mysqli_query($conn,$query))
    {
      die(mysqli_error($conn));
    }
header('Location:index.php');
exit;
}
}
//select liked_unliked part
else 
{
if(isset($_POST['liked']))
{
    $postid=$_POST['username'];
    $n=$_POST['like'];
    $sql=mysqli_query($conn,"update city_portal set likedd=$n+1 where user_name='$postid'");
}
if(isset($_POST['unliked']))
{
    $postid=$_POST['username'];
    $m=$_POST['unlike'];
    $sql=mysqli_query($conn,"update city_portal set unlikedd=$m+1 where user_name='$postid'");
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
<script>
function myFunction() 
{
    var x = document.getElementById('myDIV');
    if (x.style.display === 'block') 
    {
        x.style.display = 'none';
    
    } 
    else 
    {
        x.style.display = 'block';
    }
}
</script>
<style>
#myDIV 
{  
display: none;
}
#well
{
  min-height: 300px;
  background-color: #34495E;
}
#well:hover
{
background-color:#707B7C;
}
</style>
</head>
<body style="background-color:#34282C;">
<!--for first Row--> 
<div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <img src="images/pics01.jpg" class="img-responsive">
      </div>   
    </div>
    <br><br>
    <hr> 
</div>   
<!-- show post area -->
<?php
       $pro_select = "select * from city_portal ORDER BY likedd DESC";
       $result = mysqli_query($conn,$pro_select) ;
       while($row = mysqli_fetch_array($result)) 
       {
?>
<div class="container">
  <div class="row">
      <div class="col-lg-12">
        <div class="well" >
           <h2 style="color:#900C3F;"> 
            <?php
            echo $row['text_area']; 
             ?>
           </h2>
        </div>
      </div>
  </div>
    <br><br>
</div>
<!--Like_Unlike button -->
<div class="container">
       <form method="POST" class="form-inline col-lg-offset-5" role="form">
          <!--Like -->
          <div class="form-group">
            <input type="hidden" name="like" value="<?php echo $row['likedd'] ?>" >
            <input type="hidden" name="username" value="<?php echo $row['user_name'] ?>" >
            <button name="liked" class="btn btn-success">&nbsp&nbsp&nbsp
              <i class="fa fa-thumbs-up" aria-hidden="true" style="font-size:30px;"></i>
              &nbsp&nbsp<?php echo $row['likedd'] ?>&nbsp&nbsp&nbsp
            </button>
          </div>
          <!--Unlike button -->
          <div class="form-group">
            <input type="hidden" name="unlike" value="<?php echo $row['unlikedd'] ?>" >
            <button name="unliked" class="btn btn-success">&nbsp&nbsp&nbsp
              <i class="fa fa-thumbs-down" aria-hidden="true" style="font-size:30px;"></i>
              &nbsp&nbsp<?php echo $row['unlikedd'] ?>&nbsp&nbsp&nbsp
            </button>
          </div>
       </form>
       <hr>
</div>     
<?php
}
?> 
<!--for Comment Area form-->
<div class="container" id="myDIV">
   <div class="row">
     <div class=" col-lg-12">
        <div class="well" id="well">
              <center>
                <form method="POST" >
                   <div class="form-group">
                      <label class="control-label col-lg-2" for="comment" style="color: white;">Comment</label>
                      <div class="col-lg-10">
                         <textarea name="text" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                          <label class="control-label col-lg-2" for="comment" style="color: white;">User Name</label>
                        <div class="col-lg-10 ">
                           <input type="text" name="user" class="form-control"/>
                        </div>   
                    </div>
                    <div class="form-group">
                         <div class="col-lg-11 col-lg-offset-1">
                           <button name="sub" class="btn btn-success">&nbsp&nbsp&nbsp Submit&nbsp&nbsp&nbsp</button>
                         </div>
                    </div>
                </form>
              </center>
        </div>
    </div>
  </div> 
  <hr> 
</div>
<!--for Post button-->
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="well">
        <center>
        <button onclick="myFunction()" class="btn btn-success btn-lg">Post Your Comment</button></center>
       </div> 
    </div>
  </div>
</div>
<br><br> 
</body>
<script src="jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html> 
