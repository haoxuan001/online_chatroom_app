<?php
// require_once "chatroom.php";
// /* Attempt MySQL server connection. Assuming you are running MySQL
// server with default setting (user 'root' with no password) */
// try{
    
//     $pdo = new PDO('mysql:host=localhost; dbname=chatroom;',"root", "");
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e){
//     die("ERROR: Could not connect. " . $e->getMessage());
// }
$pdo = new PDO('mysql:host=localhost; dbname=chatroom;',"root", "");
function getInfo($userid,$chat_room_id,$connect){
    $stmt = $pdo->prepare('SELECT chat_msg, chat_date, username ,chat.chat_date,chat.chat_room_id,chat.chatid,  FROM chat, users  WHERE chat.userid = users.userid');
    $stmt =  $pdo->prepare($query);
	$stmt->execute();
    foreach($result as $row)
	{
	return $row['chatid'];
        return $row['chat_room_id'];
        return $row['userid'];
       
	}
    
}

 
// // try{
   
//     $pdo = new PDO('mysql:host=localhost; dbname=chatroom;',"root", "");
//     $stmt = $pdo->prepare('SELECT chatid,chat_msg, chat_date, username,chat_room_id FROM chat, users  WHERE chat.userd = users.userid');
//     $stmt->execute();
//     $result = $stmt->fetchAll();
//     var_dump($result);


 
//     // Execute the prepared statement
//     $stmt->execute();
//     echo "Records inserted successfully.";
// } catch(PDOException $e){
//     die("ERROR: Could not able to execute $sql. " . $e->getMessage());
// }
 


// Attempt insert query executio

    try{
   
        // Create prepared statement
        $sql = "INSERT INTO chat (chatid, chat_room_id,userid,chat_msg,chat_date) VALUES (:chatid, :chat_room_id,:userid,:chat_msg,:chat_date)";
        $stmt = $pdo->prepare($sql);
        
     
        // Bind parameters to statement
        $stmt->bindParam(':chatid', $chatid, PDO::PARAM_INT);
        $stmt->bindParam(':chat_room_id', $chat_room_id,PDO::PARAM_STR);
        $stmt->bindParam(':userid',$userid,PDO::PARAM_INT);
        $stmt->bindParam(':chat_msg', $_REQUEST['chat_msg']);
        $stmt->bindParam(':chat_date',$chat_date, PDO::PARAM_STR);
        
     
        // Execute the prepared statement
        $stmt->execute();
        echo "Records inserted successfully.";
    } catch(PDOException $e){
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }



 
// Close connection
unset($pdo);
?>
