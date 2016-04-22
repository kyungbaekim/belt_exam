<?php
  // var_dump($this->session->flashdata('registered'));
  // var_dump($this->session->all_userdata());
  if($this->session->flashdata('registered')){
    if($this->session->flashdata('registered') == true){
      echo "<script type='text/javascript'>alert('You are successfully registered. Please log in!');</script>";
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login/Registration</title>
  <style>
    .wrapper{
      width: 700px;
      /*display: flex;
      align-items: center;
      justify-content: center;*/
      margin: 20px auto;
      /*border: 1px solid grey;*/
    }
    fieldset{
      margin: 20px auto;
      width: 300px;
      border: 2px groove;
    }
    td{
      padding: 2px 0px;
    }
    form{
      width: 280px;
      margin: 20px auto;
    }
    .notice, .error{
      color: red;
      font-size: 12px;
    }
    .menu{
      height: 40px;
    }
    .register, .login{
      display: inline-block;
    }
    .login{
      margin-left: 30px;
    }
    </style>
</head>
<body>
  <div class='wrapper'>
    <div class='menu'></div>
    <div class='header'><h1>Welcome!</h1></div>
    <div class='body'>
      <div class='register'>
        <fieldset>
          <legend><h3>Or Register</h3></legend>
          <?php
            if(isset($register_errors)){
              echo $register_errors;
              echo "<br>";
            }
          ?>
          <form action='/register' method='post'>
            <table>
              <tr>
                <td width>Name:</td>
                <td><input type='text' name='name'>
              </tr>
              <tr>
                <td>User Name:</td>
                <td><input type='text' name='username'>
              </tr>
              <tr>
                <td>Password:</td>
                <td><input type='password' name='password1'>
              </tr>
              <tr>
                <td class='notice' colspan='2' valign='top'>*Password should be at leat 8 characters</td>
              </tr>
              <tr>
                <td>Confirm PW:</td>
                <td><input type='password' name='password2'>
              </tr>
              <tr><td align='right' colspan='2'><input type='submit' value='Register'></tr>
              <tr><td align='right' colspan='2'></tr>
            </table>
          </form>
        </fieldset>
      </div>
      <div class='login'>
        <fieldset>
          <legend><h3>Log In</h3></legend>
          <?php
            if(isset($login_errors)){
              echo $login_errors;
              echo "<br>";
            }
          ?>
          <form action='/login' method='post'>
            <table>
              <tr>
                <td width=100>Username:</td>
                <td><input type='text' name='username'>
              </tr>
              <tr>
                <td>Password:</td>
                <td><input type='password' name='password'>
              </tr>
              <tr><td align='right' colspan='2'><input type='submit' value='Login'>&emsp;<a href='/log_off'>Clear session</a></td></tr>
            </table>
          </form>
        </fieldset>
      </div>
    </div>
  </div>
</body>
</html>
