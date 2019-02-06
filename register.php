<?php
require_once 'core/init.php';
?>


<html>
    <head>
	    <meta charset="utf-8">		
		<title>Darbuotojo kūrimas</title>	
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/scripts.js"></script>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    </head>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">CRM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Užduotys</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Darbuotojai</a>
                    </li>                                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">Duomenų bazė</a>
                    </li>  
                </ul>                
                <ul class="nav navbar-nav navbar-right"> 
                    <a href="#"><i class='fas fa-sign-out-alt' id="logout"></i></a>
                </ul>
            </div>
        </nav>
    </header>

	<body>
        <div class="container">
            <div class="col-sm-6 offset-sm-3">
            <div class="header">
		            <h2>Pridėti darbuotoją</h2>
	            </div>

                <form method="post" action="" class="formaAplication">
                    <?php
                    if(Input::exists()){
                        if(Token::check(Input::get('token'))){
                            $validate = new Validate();
                            $validation = $validate->check($_POST, array(
                                'vardas' => array(
                                    'required' => true,
                                    'min' => 2,
                                    'max' => 20
                                ),
                                'pavarde' => array(
                                    'required' => true,
                                    'min' => 2,
                                    'max' => 20
                                ),
                                'elpastas' => array(
                                    'required' => true,
                                    'unique' => 'users',
                                    'max' => 30
                                ),
                                'slaptazodis' => array(
                                    'required' => true,
                                    'min' => 8,
                                    'max' => 64,
                                    'oneNumber' => true,
                                    'oneBigLetter' => true,
                                    'oneSmallLetter' => true,
                                    'oneSpecialSymbol' => true,
                                    'noSpaces' => true
                                ),
                                'skyrius' => array(
                                    'required' => true
                                ),
                                'pareigos' => array(
                                    'required' => true
                                )
                            ));
                            if($validation->passed()){
                                $user = new User();
                                $salt = Hash::salt(32);

                                try{
                                    $user->create(array(
                                        'vardas' => Input::get('vardas'),
                                        'pavarde' => Input::get('pavarde'),
                                        'elpastas' => Input::get('elpastas'),
                                        'slaptazodis' => Hash::make(Input::get('slaptazodis'), $salt),
                                        'skyrius' => Input::get('skyrius'),
                                        'pareigos' => Input::get('pareigos'),
                                        'salt' => $salt,
                                        'joined' => date('Y-m-d H:i:s'),
                                        'role' => Input::get('role')
                                    ));
                                    Session::flash('home', 'Jūs sėkmingai sukūrėte naują darbuotojo pakyrą');
                                    Redirect::to('index.php');

                                } catch(Exception $e){
                                    die($e->getMessage());
                                }
                            } else{
                                echo '<div class="error">';
                                foreach($validation->errors() as $error){
                                    echo $error, '<br>';
                                }
                                echo'</div>';
                            }
                        }
                    }
                    ?>

                    <fieldset>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Vardas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="vardas" id="inputName" placeholder="Vardas" value="<?php echo escape(Input::get('inputName')); ?>" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pavardė</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pavarde" id="inputSurname" placeholder="Pavardė" value="<?php echo escape(Input::get('inputSurname')); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">El. paštas</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="elpastas" id="inputEmail" placeholder="El. pašto adresas"  value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Slaptažodis</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="slaptazodis" id="inputPassword" placeholder="Slaptažodis" value="">
                            </div>
                        </div>                            

                        <div class="form-group row">          
                            <label  class="col-sm-3 col-form-label">Skyrius</label>
                            <div class="col-sm-9">
			                    <select class="form-control" name="skyrius" id="department" value="">
				                    <option value="">Pasirinkite skyrių</option>
				                    <option value="Administracija">Administracija</option>
									<option value="Apsaugos skyrius">Apsaugos skyrius</option>
                                    <option value="Finansų skyrius">Finansų skyrius</option>
                                    <option value="Komercijos skyrius">Komercijos skyrius</option>
                                    <option value="Personalo skyrius">Personalo skyrius</option>
                                    <option value="Techninis skyrius">Techninis skyrius</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">          
                            <label class="col-sm-3 col-form-label">Pareigybė</label>
                            <div class="col-sm-9">
			                    <select disabled="disabled" class="form-control subcat" name="pareigos" id="post" value="">
				                    <option value="">Pasirinkite pareigybę</option>
                                    <optgroup data-rel="Administracija">
				                        <option value="Administratore">Administratorė</option>
                                        <option value="Direktorius">Direktorius</option>
                                        <option value="Teisinikas">Teisinikas</option>
                                    </optgroup>
                                    <optgroup data-rel="Finansų skyrius">
				                        <option value="Vyr. buhalterė">Vyr. buhalterė</option>
                                        <option value="Buhalterė">Buhalterė</option>                                        
                                    </optgroup>
                                    <optgroup data-rel="Apsaugos skyrius">
				                        <option value="Skyriaus vadovas">Skyriaus vadovas</option>
                                        <option value="Padalinio vadovas">Padalinio vadovas</option>                                        
                                    </optgroup>
                                    <optgroup data-rel="Komercijos skyrius">
				                        <option value="Skyriaus vadovas">Skyriaus vadovas</option>
                                        <option value="Projektų vadovas">Projektų vadovas</option>
                                        <option value="Vadybininkas">Vadybininkas</option>
                                        <option value="Klientų aptarnavimo vadybininkas">Klientų aptarnavimo vadybininkas</option>
                                    </optgroup>
                                    <optgroup data-rel="Personalo skyrius">
				                        <option value="Skyriaus vadovas">Skyriaus vadovas</option>
                                        <option value="Vadybininkas">Vadybininkas</option>                                        
                                    </optgroup>
                                    <optgroup data-rel="Techninis skyrius">
				                        <option value="Skyriaus vadovas">Skyriaus vadovas</option>
                                        <option value="Projektų vadovas">Projektų vadovas</option>
                                        <option value="IT administratorius">IT administratorius</option>
                                        <option value="CSP inžinierius">CSP inžinierius</option>
                                        <option value="CSP vyr. operatorius">CSP vyr. operatorius</option>
                                    </optgroup>                            
                                </select>
                            </div>
                        </div>

						<div class="form-group row">          
                            <label for="exampleSelect1" class="col-sm-3 col-form-label">Darbuotojo rolė</label>
                            <div class="col-sm-9">
			                    <select class="form-control" name="role" id="" value="">				                    
									<option value="">Pasirinkite darbuotojo rolę</option>
                                    <option value="1">Administratorius</option>
									<option value="2">Skyriaus vadovas</option>
                                    <option value="3">Darbuotojas</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-inline my-2 my-lg-0">
                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">            
                            <button type="reset" class="btn btn-default mr-sm-2">Atšaukti</button>
                            <button type="submit" class="btn adminButton my-2 my-sm-0" name="register_btn">Patvirtinti</button>             
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>
