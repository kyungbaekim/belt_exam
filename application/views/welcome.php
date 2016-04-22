<?php
  // var_dump($user);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registration</title>
  <style>
    .wrapper{
      width: 550px;
      /*display: flex;
      align-items: center;
      justify-content: center;*/
      margin: 20px auto;
      /*border: 1px solid grey;*/
    }
    fieldset{
      margin: 20px auto;
      width: 500px;
      border: 2px groove;
    }
    table{
      margin: 15px;
    }
    td{
      padding: 2px 0px;
    }
    form{
      width: 350px;
      margin: 20px auto;
    }
    .menu{
      height: 30px;
      text-align: right;
    }
    </style>
</head>
<body>
  <div class='wrapper'>
    <div class='menu'>
      <a href='/log_off'>Log Off</a>
    </div>
    <div>
      <h1>Welcome <?= $user['first_name'] ?>!</h1>
      <fieldset>
        <legend><h3>User information</h3></legend>
        <table>
          <tr><td>First Name: <?= $user['first_name'] ?></td></tr>
          <tr><td>Last Name: <?= $user['last_name'] ?></td></tr>
          <tr><td>Email Address: <?= $user['email'] ?></td></tr>
        </table>
      </fieldset>
    </div>
  </div>
</body>
</html>
