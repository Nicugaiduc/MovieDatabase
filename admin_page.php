<?php 
include_once('sql_connect.php');
$sql = "SELECT * FROM users;";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div id="change_class" class="flex_container section menu_section">
  <div class="flex_item branding"><p></p></div>
  <div class="flex_item menu_item dropdown">
    <p>Menu</p>
    <div class="dropdown-content">
      <div class="menu_item menu_item_inside"><a href="admin_page.php"><p>Home</p></a></div>
      <div class="menu_item menu_item_inside"><a href="admin_add_user.php"><p>Add an User</p></a></div>
      <div class="menu_item menu_item_inside"><a href="admin_add_movie.php"><p>Add a Movie</p></a></div>
    </div>
  </div>
  <div class="flex_item menu_item menu_item_outside"><a href="admin_page.php"><p>Home</p></a></div>
  <div class="flex_item menu_item menu_item_outside"><a href="admin_add_user.php"><p>Add an User</p></a></div>
  <div class="flex_item menu_item menu_item_outside"><a href="admin_add_movie.php"><p>Add a Movie</p></a></div>
  </div>
	<h1 style="margin-top: 90px">Admin Panel</h1>
	<table style="width:100%">
  <tr>
  	<th>User_Id</th>
    <th>User_Name</th>
    <th>User_Mail</th> 
    <th>User_Password</th>
  </tr>
  <?php while($row = mysqli_fetch_assoc($result)){ ?>
  <tr>
    <td><?php echo $row['user_id']; ?></td>
    <td><?php echo $row['user_name']; ?></td>
    <td><?php echo $row['user_mail'] ?></td>
    <td><?php echo $row['user_password'] ?></td>
    <td><a href="delete.php?delete=<?php echo $row['user_id'];?>">Delete User</a></td>
  </tr>
  <?php } ?>
</table>
</body>
</html>
