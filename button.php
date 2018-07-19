<html>
<head>
 <meta http-equiv="refresh" content="3">
 </head>
<?PHP
$conn=mysqli_connect("localhost","root","","project");
if(!empty($_POST['onoffswitch']))
{
  $flag=1;
}
else
{
  $flag=0;
}
$t="truncate table button";
mysqli_query($conn,$t);
$q="insert into button(onoff) values('$flag')";
mysqli_query($conn,$q);
mysqli_commit($conn);
?>
</html>
