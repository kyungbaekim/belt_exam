<?php
  // var_dump($this->session->all_userdata());
  // var_dump($trips);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Travel Dashboard</title>
  <style>
    .wrapper{
      width: 700px;
      /*display: flex;
      align-items: center;
      justify-content: center;*/
      margin: 20px auto;
      /*border: 1px solid grey;*/
    }
    table{
      /*border: 1px solid black;*/
      border-collapse: collapse;
      margin-bottom: 50px;
    }
    th, td{
      padding: 2px 5px;
      border: 1px solid black;
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
    </style>
</head>
<body>
  <div class='wrapper'>
    <div class='menu'><a href='/log_off'>Logout</a></div>
    <div class='header'><h1>Hello, <?= $this->session->userdata['user_name'] ?>!</h1></div>
    <div class='body'>
      <div class='top'>
        <h3>Your Trip Schedules</h3>
        <table>
          <tr><th>Destination</th><th>Travel Start Date</th><th>Travel End Date</th><th>Plan</th><tr>
            <?php
              foreach ($trips as $key => $value) {
                if($value['user_id'] == $this->session->userdata['user_id'] || $value['join_id'] == $this->session->userdata['user_id']){
                  echo "<tr>";
                  echo "<td><a href='/detail/".$value['trip_id']."'>".$value['destination']."</a></td>";
                  echo "<td>".$value['startdate']."</td>";
                  echo "<td>".$value['enddate']."</td>";
                  echo "<td>".$value['description']."</td>";
                  echo "</tr>";
                }
              }
            ?>
        </table>
      </div>
      <div class='bottom'>
        <h3>Other User's Travel Plans</h3>
        <table>
          <tr><th>Name</th><th>Destination</th><th>Travel Start Date</th><th>Travel End Date</th><th>Do You Want to Join?</th><tr>
            <?php
            foreach ($trips as $key => $value) {
              if($value['user_id'] != $this->session->userdata['user_id'] && $value['join_id'] != $this->session->userdata['user_id']){
                echo "<tr>";
                echo "<td>".$value['name']."</td>";
                echo "<td>".$value['destination']."</td>";
                echo "<td>".$value['startdate']."</td>";
                echo "<td>".$value['enddate']."</td>";
                echo "<td><a href='/join_travel/".$value['trip_id']."'>Join</a></td>";
                echo "</tr>";
              }
            }
            ?>
        </table>
        <p align=right><a href='/add'>Add Travel Plan</a></p>
      </div>
    </div>
  </div>
</body>
</html>
