<?php
require_once 'core/init.php';

if(!$elpastas = Input::get('user')){
    Redirect::to('index.php');
} else{
    $user = new User();
    if(!$user->exists()){
        Redirect::to(404);
    } else{
        $data = $user->data();
    }
    ?>

    <h3><?php echo escape($data->elpastas); ?></h3>
    <p>Vardas yra: <?php echo escape($data->vardas); ?></p>
    <p>Pavardė yra: <?php echo escape($data->pavarde); ?></p>
    <p>Dirba <?php echo escape($data->skyrius); ?> </p>
    <p>Pareigos <?php echo escape($data->pareigos); ?></p>
    <?php
}