<?php
session_start();

if($_SESSION['auth'] == 1){
    $link = mysqli_connect('localhost', 'root', '', 'task');
    
    if($_GET['action'] == 'logout'){
        session_start();
        session_destroy();
        header("Location: http://".$_SERVER['HTTP_HOST']."/");
    }
    $id = $_SESSION['id'];
    if($_GET['action'] == 'plus'){
        $query = mysqli_query($link, "UPDATE users SET counter=counter+1 WHERE id=$id");        
    }
    $count = mysqli_query($link, "SELECT counter FROM users WHERE id=$id");
    $count = mysqli_fetch_array($count);    
    }else{
        session_destroy();
        header("Location: http://".$_SERVER['HTTP_HOST']."/");
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href='css/bootstrap.css' rel='stylesheet' type='text/css' media='all'>
	<title>Counter</title>
</head>

<body>
<div class="count">
    <h1 style="font-size: 4em; margin-left: 40px;"><?=$count['counter']?></h1>
    <a style="margin-right: 20px;" href='counter.php?action=plus' class="btn btn-success">+1</a>
    <a href='counter.php?action=logout'>Logout</a>
</div>
</body>
</html>
<?php
	mysqli_close($link);
?>