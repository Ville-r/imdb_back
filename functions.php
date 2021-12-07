<?php
// funktio tietojen hakuun tietokannasta ja tietojen tulostukseen JSON-muodossa.
function selectAsJson(object $db,string $sql): void {
    $query = $db->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    echo json_encode($results);
}
//Errorin tiedot, jos mennään catchiin.
function returnError(PDOException $pdoex): void {
    header('HTTP/1.1 500 Internal Server Error');
    $error = array('error' => $pdoex->getMessage());
    echo json_encode($error);
    exit;
}
//tällä funktiolla luodaan tietokantayhteys. Catch mahdollisia virhetilanteita varten.
function createDbConnection(){
    try{
        $dbcon = new PDO('mysql:host=localhost;dbname=imdb', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo $e->getMessage();
    }
    return $dbcon;
}