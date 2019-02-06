<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'elpastas' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));
        if($validation->passed()){
            try{
                $user->update(array(
                    'elpastas' => Input::get('elpastas')
                ));
                Session::flash('home', 'Sėmingai atnaujinti duomenys');
                Redirect::to('index.php');

            } catch (Exception $e){
                die($e->getMessage());
            }

        }else{
            foreach($validation->errors() as $error){
                echo $error, '<br>';
            }
        }
    }
}

?>

<form action="" method="post">
    <div class="field">
        <label for="elpastas">El pastas</label>
        <input type="email" name="elpastas" value="<?php echo escape($user->data()->elpastas); ?>">
        <input type="submit" value="Update">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    </div>
</form>