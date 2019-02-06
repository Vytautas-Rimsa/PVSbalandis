

<html>
    <head>
	    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">		
		<title>Darbuotojų sąrašas</title>	
        <link rel="stylesheet" href="../../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/scripts.js"></script>
        <script type="text/javascript" src="../../js/main.js"></script>
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
                        <a class="nav-link" href="../../tasks/admin/activeTasks.php">Užduotys</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Darbuotojai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Duomenų bazė</a>
                    </li>   
                </ul>                
                <form class="nav navbar-nav navbar-right" action="search.php" method="POST">				
                    <li class="form-inline my-2 my-lg-0" >
                        <input class="form-control mr-sm-2" type="text" placeholder="Paieška" name="search" id="search" onkeyup="enableSearchButton()">
                        <button class="btn btn-secondary mr-sm-4" type="submit" name="submit-search" id="searchButton" disabled>Paieška</button>
                    </li>					
                    <a href="../../logout.php"><i class='fas fa-sign-out-alt' id="logout"></i></a>
                </form>
            </div>
        </nav>
    </header>

	<body id="page-top">	
        <div class="container">
            <div><h3>Darbuotojų sąrašas</h3></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nr.</th>
                        <th scope="col">Vardas</th>
                        <th scope="col">Pavardė</th>
                        <th scope="col">El. paštas</th>
                        <th scope="col">Skyrius</th>
                        <th scope="col">Pareigos</th>
                        <th scope="col">Vartotojo rolė</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                
                <tbody>
                <!--<?php $i = 1; while ($row = mysqli_fetch_array($darbuotojai)) { ?>  -->             
                    <tr class="table-light">
                        <th scope="row"></th>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td class=""><a href="<!--editUser.php?editUser=<?php echo $row['darb_id']; ?>-->"><i class='fas fa-edit' id="actions"></i></a></td>
                        <td class=""><a href="<!--users.php?del_user=<?php echo $row['darb_id']; ?>-->"><i class='fas fa-trash-alt' id="actions"></i></a></td>
                    </tr>
                <!--<?php $i++;} ?>    -->               
                </tbody>
            </table>

            <div class="my-2 my-lg-0 addUser">
                <a href="create_user.php"><button type="submit" class="btn adminButton my-2 my-sm-0" name="addUser_btn">Pridėti darbuotoją</button></a>                                  
            </div>
        </div>
        <div class="scroll-to-top rounded">
            <span><a href=""><i class="fas fa-angle-up" style='font-size:48px;color:white'></i> </a></span>            
        </div>
    </body>
</html>
