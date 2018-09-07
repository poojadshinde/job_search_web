<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.standalone.min.css">
      <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
      <link href="https://fonts.googleapis.com/css?family=PT+Serif|Roboto" rel="stylesheet">
    <title>Hello, world!</title>
  </head>
  <body>
  	<nav class="navbar navbar-expand-md navbar-light bg-light  py-3">
  <div class="container">
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent13" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent13">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active mx-2">
        <form action="<?php echo site_url('user/search_keyword');?>" method = "get">
          <div class="input-group">
            <input type="text" class="form-control" name="q" placeholder="Search for..." aria-label="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-info" type="submit" value="search"><i class="fa fa-search"></i></button>
            </span>
          </div>
          </form>
        </li>

      </ul>
    </div>
    <!--<form action="<?php echo site_url('user/search_keyword');?>" method = "post">
<input type="text" name = "keyword" />
<input type="submit" value = "Search" />
</form>-->
  </div>
</nav>