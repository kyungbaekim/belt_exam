<?php
  // var_dump($this->session->all_userdata());
  // var_dump($trips);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Plan</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/black-tie/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-2.2.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $(".to").datepicker();
    $(".from").datepicker();
  });
  </script>
  <style>
    .wrapper{
      width: 700px;
      /*display: flex;
      align-items: center;
      justify-content: center;*/
      margin: 20px auto;
      /*border: 1px solid grey;*/
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
    </style>
</head>
<body>
  <div class='wrapper'>
    <div class='menu'><a href='/travels'>Home</a>&emsp;<a href='/log_off'>Logout</a></div>
    <div class='header'><h1>Add a Trip</h1></div>
    <div class='body'>
      <form action='/add_travel' method='post'>
        <?php
          if(isset($travel_errors)){
            echo $travel_errors;
            echo "<br>";
          }
        ?>
        <table>
          <tr>
            <td>Destination: </td>
            <td><input type='text' name='destination'></td>
          <tr>
          <tr>
            <td>Description: </td>
            <td><input type='text' name='description'></td>
          <tr>
          <tr>
            <td>Travel Date From: </td>
            <td><input type='text' class='from' name='from'></td>
          <tr>
          <tr>
            <td>Travel Date To: </td>
            <td><input type='text' class='to' name='to'></td>
          <tr>
          <tr>
            <td colspan='2' align=right><input type='submit' value='Add'></td>
          <tr>
        </table>
      </form>
    </div>
  </div>
</body>
</html>
