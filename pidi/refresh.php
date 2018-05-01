<?php
/**
 * Created by PhpStorm.
 * User: darqwski
 * Date: 30.04.18
 * Time: 12:42
 */
include('createdArticles.php');

function saveArticlesToBase($articles){

    foreach ($articles as $article){
        insertCommand($article->getSQLStatement());
    }
}

function getArticlesFromItem($dom,$category,$site){
    $i=0;
    $articles=Array();
    while(is_object($item = $dom->getElementsByTagName("item")->item($i))) {
        $article=new article($item,$category,$site);
        $articles[count($articles)]=$article;
        $i++;
    }
    return $articles;
}


function refreshLink($number){
    $rss=sendCommand("SELECT * FROM `table_of_rss`");
    if(isset($rss[$number]['rss']))$file=file_get_contents($rss[$number]['rss']);
    else return "stop";
    $dom = new DOMDocument();
    $dom->loadXML($file);

    $articles=getArticlesFromItem($dom,$rss[$number]['category'],$rss[$number]['site']);
    saveArticlesToBase($articles);
    return $rss[$number]['rss'];
}
function moveRecords(){


    insertCommand("DELETE FROM `articles` WHERE `date`>DATE_SUB(CURDATE(), INTERVAL  -24 HOUR )");
    insertCommand("INSERT INTO `articles` 
SELECT (`id` + ( SELECT MAX( `id` ) FROM `articles` ) ),`title`, `link`, `img`, `site`, `category`, `date`
FROM `articlesTemp` 
WHERE `date` >DATE_SUB(NOW(), INTERVAL 24 HOUR)");
    insertCommand("TRUNCATE `articlesTemp`");
    return "Base has been refreshed";
}

/*
 * Engine of refreshing database
 * Depends on GET parametr,
 * @link -> refresh only one rss
 * @move -> moving articles from articlesTemp to articles NECESSERY!
 * @all -> refresh all rss in database and move them
 */
if(isset($_GET['link'])){
    echo refreshLink($_GET['link']);
}
if(isset($_GET['special'])){

    createWheatherArticle();
    echo "Artykuł pogodowy";
}

else if(isset($_GET['move']))
    echo moveRecords();

else if(isset($_GET['all'])){
    $rss=sendCommand("SELECT 'rss' FROM `table_of_rss`");
    for($i=0;$i<count($rss);$i++)
        refreshLink($i);
    moveRecords();
}


