<?php
  // var_dump($this->session->all_userdata());
  // var_dump($joiners);
  // var_dump($travel_info);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Destination</title>
  <style>
    .wrapper{
      width: 700px;
      margin: 20px auto;
    }
    td{
      padding: 2px 10px 0px 0px;
      /*border: 1px solid black;*/
      margin: 0px
    }
    th{
      background-color: lightgrey;
    }
    .menu{
      height: 40px;
      text-align: right;
    }
    h3{
      margin: 10px 0px;
    }
    .notice, .error{
      color: red;
      font-size: 12px;
    }
    .top{
      margin-bottom: 50px;
    }
    </style>
</head>
<body>
  <div class='wrapper'>
    <div class='menu'><a href='/travels'>Home</a>&emsp;<a href='/log_off'>Logout</a></div>
    <div class='body'>
      <div class='top'>
        <h1><?= $travel_info['destination'] ?></h1>
        <p>Planned By: <?= $travel_info['name'] ?></p>
        <p>Description: <?= $travel_info['description'] ?></p>
        <p>Travel Date From: <?= $travel_info['startdate'] ?></p>
        <p>Travel Date To: <?= $travel_info['enddate'] ?></p>
      </div>
      <div class='bottom'>
        <h1>Other users' joining the trip:</h1>
        <?php
        foreach ($joiners as $key => $value) {
          echo "<p>".$value['name']."</p>";
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
