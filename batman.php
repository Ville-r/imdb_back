<?php

//funktiot käyttöön
require('functions.php');

try {
//muuttuja tietokantayhteydelle
$dbcon = createDbConnection();
//SQL-lause, jolla halutut tiedot yritetään hakea. Catch mahdollisia virhetilanteita varten. Tässä
// siis halutaan hakea 10 parasta Batman-aiheista nimikettä. Lajitellaan annettujen pisteiden perusteella laskevaan järjestykseen.
selectAsJson($dbcon, 'SELECT titles.title_id, primary_title, start_year, average_rating 
    FROM titles, had_role, title_ratings
    WHERE titles.title_id = had_role.title_id AND role_ LIKE "%Batman%" AND titles.title_id = title_ratings.title_id
    group BY titles.title_id 
    order by average_rating DESC
    LIMIT 10');
}catch (PDOException $pdoex) {
        returnError($pdoex);
}

    


