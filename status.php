<html>
<head>
  <title>Status</title>
</head>
<body align="center">
  <style>
  .onoffswitch {
    position: relative; width: 90px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "ON";
    padding-left: 10px;
    background-color: #34A7C1; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "OFF";
    padding-right: 10px;
    background-color: #EEEEEE; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 18px; margin: 6px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 56px;
    border: 2px solid #999999; border-radius: 20px;
    transition: all 0.3s ease-in 0s;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px;
}

 body {
  background-color: teal;
}
#tb {
  font-size: 20px;
  font-style: normal;
  font-family: fantasy;
}
  </style>
  <?PHP
$conn=mysqli_connect("localhost","root","","project");
date_default_timezone_set('Asia/Kolkata');
$x= date('H:i:s');
$q="select * from irrigation where time<'$x'";
$r=mysqli_query($conn,$q);
$c=0;
while($m=mysqli_fetch_array($r))
{
$temp[$c]=$m;
$c=$c+1;
}
for($i=$c-2;$i>=0;$i--)
{
  if($temp[$c-1]['status']!=$temp[$i]['status'])
  {
    $a=$temp[$i]['time'];
    break;
  }
  else {
    $a=$temp[0]['time'];

  }
}
?>
  <br>
  <br>
  <table id="tb" align ="center" cellpadding="16%">
    <tr>
<td>Moisture Content:</td>
<td><input type="text" name="mc" value="<?php echo $temp[$c-1]['moisture'] ?>"></td>
    </tr>
    <tr>
      <td>pH value:</td>
      <td><input type="text" name="ph" value="<?php echo $temp[$c-1]['ph'] ?>"></td>
    </tr>
    <tr>
      <td>State of pump:</td>
      <td><input type="text" name="state" value="<?php echo $temp[$c-1]['status'] ?>"></td>
    </tr>
    <tr>
      <td>Pump last used:</td>
      <td><?PHP echo $a; ?></td>
    </tr>
    <tr>
      <td>Pump:</td>
      <td>
        <div class="onoffswitch">
            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" <?php
          if ($temp[$c-1]['status']==1) {?> checked <?php } ?>>
            <label class="onoffswitch-label" for="myonoffswitch">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
</td>
</tr>
</table>
</body>
</html>
