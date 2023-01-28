<!doctype html>
<html lang="en">
  <head>
    <title>BillyGram</title>
    <link rel="stylesheet" href="\MediaQuick\SMstyle.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
  </head>
<body class="bgColor">
	<header>
    <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3">
        
    <a class="navbar-brand" href="\MediaQuick\User\UserPage.php">BillyGram</a>

    <a class="nav-link text-dark" href="\MediaQuick\User\Update.php">Update</a> 

    <a class="nav-link text-dark" href="\MediaQuick\User\Post.php">Post</a>

    
    
    <form class="d-flex" action="\MediaQuick\Navbars\search.php" method="search">
      <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

    <a class="nav-link text-dark" href="\MediaQuick\User\LogoutU.php">Logout</a> 

  </nav>
