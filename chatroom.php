<?php
// Initialize the session
session_start();
require_once "insert.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="styles.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css"/>
      <script src="https://kit.fontawesome.com/5384af5311.js" crossorigin="anonymous"></script>
      <title>Online Chat</title>
   </head>
   <body>
      <header>
         <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
               <a href="/index.html" class="navbar-brand d-flex align-items-center">
               <i class="fas fa-anchor"></i>
               <strong>Home</strong>
               </a>
            </div>
            <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
            <p>
                <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
                <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
            </p>
         </div>
      </header>
      <!-- container & title -->
      <div class="container my-4">
         <h1 class="my-4 text-center">Please  choose a chatroom:</h1>
         <!-- buttons for chatrooms -->
         <div class="chat-rooms mb-3 text-center">
            <a href="#" class="btn btn-outline-primary" role="button" data-bs-toggle="button" id="general">#general</a>
            <a href="#"class="btn btn-outline-secondary" role="button" data-bs-toggle="button" id="gaming">#gaming</a>
            <a href="#" class="btn btn-outline-success" role="button" data-bs-toggle="button" id="music">#music</a>
            <a href="#" class="btn btn-outline-info" role="button" data-bs-toggle="button" id="ninjas">#ninjas</a>
         </div>
         <tbody>
            <div class="chat-message">
               <?php 
                  try{
                        
                     $pdo = new PDO('mysql:host=localhost; dbname=chatroom;',"root", "");
                     $stmt = $pdo->prepare('SELECT * FROM chat, users  WHERE chat.userid = users.userid');
                     $stmt->execute();
                     
                     foreach($stmt as $row ){
                        echo '<li class=" list-group-item  alert-success">' . $row['chat_msg'] . 
                        '<span class="time"><br>'. $row['chat_date'] .' </span>';
                        '</li>';
                        echo 'by <strong><span class="username">'. $row['username'] .' </strong></span> #gengeral';
                       
                     }
                   var_dump($row);
                  }catch (PDOException $e) {
                     print "Error!: " . $e->getMessage() . "<br/>";
                     die();
                 }
                     
    
               ?>	
               </div>
         </tbody>
         <!-- chat list / window -->
         <div class="chat-window">
            <ul class="chat-list list-group"></ul>
         </div>
         <!-- new chat form -->
         <form class="new-chat my-3" action="insert.php" method="post">
            <div class="input-group">
               <div class="input-group-prepend">
                  <div class="input-group-text">Your message:</div>
               </div>
               <input type="hidden" id="chatid" name="chatid" value="$row['chatid']">
               <input type="hidden" id="chat_room_id" name="chat_room_id"  value="($row['chat_room_id']" >
               <input type="hidden" id="user_id" name="user_id" value="$row['user_id']" >
               <input type="text" id="chat_msg" name="chat_msg" class="form-control" required>
               <input type="hidden" id="chat_date" name="chat_date" value="$row['chat_date']" >
               <div class="input-group-append">
                  <button type="submit" class="btn btn-primary" name ="send" value="send">Send</button>
               </div>
            </div>
        
         </form>
         <!-- update name form -->
         <form class="new-name my-3">
            <div class="input-group">
               <div class="input-group-prepend">
                  <div class="input-group-text">Update name:</div>
               </div>
               <input type="text" id="name" class="form-control" required>
               <div class="input-group-append">
               <button type="submit" class="btn btn-primary" value="update">update</button>
               </div>
            </div>
            <div class="update-mssg"></div>
         </form>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/1.9.0/date_fns.min.js" integrity="sha512-ToehgZGJmTS39fU8sfP9/f0h2Zo6OeXXKgpdEgzqUtPfE5By1K/ZkD8Jtp5PlfdaWfGVx+Jw5j10h63wSwM1HA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://www.gstatic.com/firebasejs/7.0.0/firebase-app.js"></script>
      <script src="https://www.gstatic.com/firebasejs/7.0.0/firebase-firestore.js"></script>     
      <script src="scripts/chat.js"></script>
      <script src="scripts/ui.js"></script>
      <script src="scripts/app.js"></script>
   </body>
</html>