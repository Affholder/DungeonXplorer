<?php 
    require_once 'con_db.php';

$req = $db->query('SELECT * from Chapter');
while ($ch = $req->fetch(PDO::FETCH_ASSOC)) {
    echo $ch['id'].' '.$ch['content'];
}

$req->closeCursor();
?>