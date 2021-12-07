<?php

//funktiot käyttöön
require('functions.php');

try {
//muuttuja tietokantayhteydelle
$dbcon = createDbConnection();
//yritetään hakea tiedot tietokannasta sql-lauseella. Catch mahdollisia virhetilanteita varten. Tässä siis haetaan
// Suomessa julkaistuja kestoltaan lyhyimpiä nimikkeitä, jotka kuuluvat Comedy-kategoriaan ja ovat tyypiltään MOVIE
// Keston täytyy olla suurempi kuin 0 ja tulostusjärjestys on keston perusteella nouseva. Tulostetaan kymmenen lyhintä nimikettä.
selectAsJson($dbcon, 'SELECT titles.title_id, primary_title, start_year, runtime_minutes
    FROM titles, aliases, title_genres
    WHERE titles.title_id = aliases.title_id AND titles.title_id = title_genres.title_id 
    AND title_type = "movie" AND runtime_minutes > 0 AND genre = "Comedy\r" AND region = "FI"
    group BY titles.title_id 
    order by runtime_minutes ASC
    LIMIT 10');
}catch (PDOException $pdoex) {
        returnError($pdoex);
}
