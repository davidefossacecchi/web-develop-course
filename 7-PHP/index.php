<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My First Script in PHP</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <h1>My Form</h1>
      <?php if ($_POST["submit"]=="Submit"): 
        if($_POST['name'] && $_POST['surname'] && $_POST['email']):
          $mail=mail($_POST['email'],"Your form has been submitted","Congratulations, your form has been correctly submitted", "From: suxmassiccio@gmail.com");
          if($mail):?>
            <div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Email correctly sent!</div>

          <?php else: ?>
            <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Mail not sent</div>
          <?php endif;
        else: ?>
        <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Some field is blank</div>
        <?php endif; 
      endif;?>

      <form method="POST">
        <div class="form-group">
            <input type="text" placeholder="Name" class="form-control" name="name"/>
        </div>
        <div class="form-group">
            <input type="text" placeholder="Surname" class="form-control" name="surname"/>
        </div>
        <div class="form-group">
            <input type="email" placeholder="Email" class="form-control" name="email"/>
          </div>
          <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-default" name="submit"/>
          </div>
      </form>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.1.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>