<?php

include('variables.php');
/*
 * @param $command -> SQL COMMAND
 * For SELECT command
 */
function sendCommand($command){
    global $PDO_passwd;
    global $PDO_login;
    global $PDO_text;
    try {$db = new PDO($PDO_text, $PDO_passwd, $PDO_login);}
    catch (PDOException $e) {print "Błąd połączenia z bazą!: " . $e->getMessage() . "<br/>";}
    try{
        $records = $db->query($command);
	    $return=$records->fetchAll(PDO::FETCH_ASSOC);
        return $return;
    } catch (PDOException $e){
        return "DATABASE ERROR";
    }

    

}
/*
 * @param $command -> SQL COMMAND
 * Function bassicly for insert command which return only number of new,change records
 * For : INSERT INTO, UPDATE, DELETE FROM and TABLE modulators
 */
function insertCommand($command){
    global $PDO_passwd;
    global $PDO_login;
    global $PDO_text;
    try {$db = new PDO($PDO_text, $PDO_passwd, $PDO_login);}
    catch (PDOException $e) {print "Błąd połączenia z bazą!: " . $e->getMessage() . "<br/>";}
	$return = $db->exec($command);
	return $return;
	
}
