<?php
/**
 * Created by PhpStorm.
 * User: darqwski
 * Date: 30.04.18
 * Time: 12:05
 */

include('PDO.php');
include('variables.php');

function buildWhereClause(){

    //Initiation of category,sites and dates
    global $dateFiltr;
    $dateFiltr['today'] ="`date` > DATE_ADD( NOW( ) , INTERVAL -24 HOUR ) ";
    $dateFiltr['yester']= "`date` > DATE_ADD( NOW( ) , INTERVAL -48 HOUR ) AND `date` < DATE_ADD( NOW( ) , INTERVAL -24 HOUR )";
    $dateFiltr["2ago"]='`date` = DATE_ADD( CURDATE( ) , INTERVAL -2 DAY ) ';
    $dateFiltr["3ago"]='`date` = DATE_ADD( CURDATE( ) , INTERVAL -3 DAY ) ';
    $dateFiltr["lastweek"]='`date` > DATE_ADD( CURDATE( ) , INTERVAL -7 DAY ) ';
    $dateFiltr["previousweek"]='`date` > DATE_ADD( CURDATE( ) , INTERVAL -14 DAY ) AND `date` < DATE_ADD( CURDATE( ) , INTERVAL -7 DAY ) ';
    $dateFiltr["4ago"]='`date` = DATE_ADD( CURDATE( ) , INTERVAL -4 DAY )';
    $dateFiltr["5ago"]='`date` = DATE_ADD( CURDATE( ) , INTERVAL -5 DAY )';
    $dateFiltr["6ago"]='`date` = DATE_ADD( CURDATE( ) , INTERVAL -6 DAY )';
    $parts=explode('|',$_GET['filtr']);

    $category=sendCommand("SELECT DISTINCT `category` FROM `table_of_rss` ORDER BY `category` ASC");
    $sites=sendCommand("SELECT DISTINCT `site` FROM `table_of_rss`ORDER BY `site` ASC ");

    //Segregation for date, category and site, neccesery for build SQLstatement
    for($i=0;$i<count($parts);$i++){

        for($j=0;$j<count($category);$j++) if($parts[$i]==$category[$j]['category']){
            $categoryClause[count($categoryClause)]=$parts[$i];
        }
        for($j=0;$j<count($sites);$j++) if($parts[$i]==$sites[$j]['site']){
            $siteClause[count($siteClause)]=$parts[$i];
        }
        if(array_key_exists($parts[$i],$dateFiltr)) {
            $dateClause[count($dateClause)]=$dateFiltr[$parts[$i]];
        }
    }

    //Building whole where statement
    $categoryClause= getClause($categoryClause,"`category`");
    $siteClause=getClause($siteClause,"`site`");
    $dateClause=getClause($dateClause,"`date`");
    $finalClause="";
    $finalClause.=$categoryClause;
    if($categoryClause!=""&&($siteClause!=""))$finalClause.=" AND ";
    $finalClause.=$siteClause;
    if($dateClause!=""&&($siteClause!=""||$categoryClause!=""))$finalClause.=" AND ";
    $finalClause.=$dateClause;
    if($finalClause!="")$finalClause="WHERE ".$finalClause;
    return $finalClause;



}
function getClause($array,$type){
    $clause="";
    switch(count($array)){
        case 0:
        return "";
        case 1:
           if($type!="`date`") return $type.'='.'"'.$array[0].'"';
           else return $array[0];
            break;
        default:
            for($i=0;$i<count($array);$i++){
                if($type!="`date`")
                    $clause.=$type.'="'.$array[$i].'" OR ';
                else
                    $clause.=$array[$i].' OR ';
            }

            $clause="(".substr($clause,0,count($clause)-5).")";
            return $clause;
    }
}
function getArticlesFromBase($whereClause,$downNumber){
    $articles=sendCommand("SELECT * FROM `articles`".$whereClause." LIMIT ".$downNumber.",10");
    global $logo_of_site;
    for($i=0;$i<10;$i++){
        $articles[$i]['sitefoto']=$logo_of_site[$articles[$i]['site']];
        if( $articles[$i]['img']=="")$articles[$i]['img']=$articles[$i]['sitefoto'];
    }
        $articles[$i]['sitefoto']=$logo_of_site[$articles[$i]['site']];
    echo json_encode( $articles);
}

/*
 * MAIN PART
 */
if(isset($_GET['filtr'])){
    $whereClause=buildWhereClause();
    getArticlesFromBase($whereClause,$_GET['count']);

}
if(isset($_GET['params'])){
   if($_GET['params']=="date"){
       global $dateFiltr;
       $dateFiltr[0]["date"]='today';
       $dateFiltr[1]["date"]='yesterday';
       $dateFiltr[2]["date"]='2ago';
       $dateFiltr[3]["date"]='3ago';
       $dateFiltr[4]["date"]='lastweek';
       $dateFiltr[5]["date"]='previousweek';
       $dateFiltr[6]["date"]='4ago';
       $dateFiltr[7]["date"]='5ago';
       $dateFiltr[8]["date"]='6ago';

       echo json_encode($dateFiltr);
   }
   else if($_GET['params']=="category"){
       echo json_encode(sendCommand('SELECT DISTINCT `category` FROM `table_of_rss`'));
   }
   else if($_GET['params']=="site"){
       echo json_encode(sendCommand('SELECT DISTINCT `site` FROM `table_of_rss`'));
   }

}



















