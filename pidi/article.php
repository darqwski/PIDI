<?php
/**
 * Created by PhpStorm.
 * User: darqwski
 * Date: 30.04.18
 * Time: 13:30
 */

class article{
    private $title;
    private $link;
    private $img;
    private $date;
    private $category;
    private $site;
    private $SQLStatement;

    public function __construct($item,$category,$site)
    {
        $this->setCategory($category);
        $this->setSite($site);

        foreach($item->childNodes as $node)
        {

            switch ($node->nodeName){
                case "title":
                    $this->setTitle($node->nodeValue);
                    break;
                case "link":
                    $this->setLink($node->nodeValue);
                    break;
                case "pubDate":
                    $date = strtotime($node->nodeValue);
                    $this->setDate(date('Y-m-d H:i:s',$date));
                    break;
                case "description":

                   $img=explode('src="',$node->nodeValue);
                   $img=explode('"',$img[1]);
                  $this->setImg($img[0]);
                    break;

            }

        }
        $this-> setSQLStatement();

    }
    public function setSQLStatement(){

        $SQLStatement="INSERT INTO `articlesTemp` ( `title`, `link`, `img`, `site`, `category`, `date`) VALUES ('".$this->getTitle()."','".$this->getLink()."', '".$this->getImg()."', '".$this->getSite()."','".$this->getCategory()."', '".$this->getDate()."');";
        $this->SQLStatement= $SQLStatement;
    }

    public function getSQLStatement(){
        return $this->SQLStatement;
    }
    /**
     * @return mixed
     */
    public function getCategory(){
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getImg(){
        return $this->img;
    }

    /**
     * @return mixed
     */
    public function getDate(){
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getLink(){
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function getSite(){
        return $this->site;
    }

    /**
     * @return mixed
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @param mixed $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


};