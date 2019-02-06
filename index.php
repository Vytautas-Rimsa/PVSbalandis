<?php
require_once 'core/init.php';

if(Session::exists('home')){
    echo Session::flash('home');
}

$user = new User();
if($user->isLoggedIn()){
?>
    <p>Sveiki, <a href="profile.php?user=<?php echo escape($user->data()->elpastas); ?>"><?php echo escape($user->data()->elpastas); ?></a></p>

    <ul>
        <li><a href="logout.php">Log out</a></li>
        <li><a href="update.php">Update details</a></li>
        <li><a href="changepassword.php">Update password</a></li>
    </ul>
<?php
    if($user->hasPermission('admin')){
        echo '<p>Tu esi administratorius</p>';
    }    
} else{
    echo '<p>Tu turi arba <a href="login.php"> PRISIJUNGTI </a> arba <a href="register.php"> PRISIREGISTRUOTI</a></p>';
}