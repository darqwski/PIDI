<?php
/**
 * Created by PhpStorm.
 * User: darqwski
 * Date: 01.05.18
 * Time: 10:57
 */
include("article.php");
include("PDO.php");
function createWheatherArticle(){
    $file=file_get_contents("http://dobrapogoda24.pl/wojewodztwo/pogoda-malopolskie");
    $dom= new DOMDocument();
    $dom->loadHTML($file);
    $mainElement=$dom->getElementById("relativeMain");
    $article = new article();
    $title="";
    $img="";

    foreach($mainElement->childNodes as $node)
    {
        foreach ($node->attributes as $attr){
            if($attr->name=="id"){
                switch ($attr->value){
                    case "cityMain":
                        $title.="Temperatura dla ".$node->nodeValue.', ';
                        break;
                    case "tempMain":
                        $title.="Dzień:".$node->nodeValue."/";
                        break;
                    case "iconMain":
                        $img='http://dobrapogoda24.pl'.($node->childNodes[1]->attributes[2]->value);
                        break;
                    case "tempnightMain":
                        $title.="NOC:".substr($node->nodeValue,3,count($node->value)-1)."C";
                }

            }


        }
       // print_r($node->attributes);
      //  echo $node->nodeName." - >". $node->nodeValue."</br>";
    }

        $article->setTitle($title);
        $article->setImg($img);
        $article->setCategory("PIDI");
        $article->setSite("http://darqwski.cba.pl/pidi");
        $article->setLink("http://darqwski.cba.pl/pidi");
        $article->setDate( date("Y-m-d"));
        $article->setSQLStatement();
       sendCommand( $article->getSQLStatement());
       echo $article->getSQLStatement();

}

createWheatherArticle();