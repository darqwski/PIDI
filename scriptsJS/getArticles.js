counterOfArticles=0;
articlesdownloadpossinility=true;
optimumTimeDownload=5000;

function getFiftyArticles(starter,thisFiltr){
    articlesdownloadpossinility=false;
    let counterOfArticles=0;
    for(let i=starter;i<starter+50;i+=10)
    {
        let isFull=0;
        setTimeout(function(){
            isFull=getArticles(thisFiltr,i)},(i-starter)*100)
    }
    setTimeout(function () {articlesdownloadpossinility=true;},optimumTimeDownload)
}
$(document).on("scroll",function(e){


if(Math.abs(document.body.scrollHeight -window.innerHeight-$(document).scrollTop())<200){
    if(articlesdownloadpossinility){
        getFiftyArticles(counterOfArticles)
        counterOfArticles+=50;
    }

}
})
function getCommand() {
    var command="filtr="
var containers=document.getElementsByName("filtres");
for(var i=0;i<containers.length;i++)
    if(containers[i].checked)
        command+=(containers[i].value+"|")
return command
}

function getArticles(filtrLine,counter) {
    var received=[];
    var articles=[]
    var link="http://darqwski.cba.pl/PIDI/antek.php?"+filtrLine+"&count="+(counter);
    $.get(link,function(data) {
            try{received=JSON.parse(data)}
            catch (error){
                console.log(link)
                console.log(data);
            }
            for(var i=counter;i<counter+10;i++)
            {
                if(!received["title"+i])break
                articles[articles.length]=(new article(
                    received["title"+i].replace("&qout;","\""),
                    received["link"+i],
                    received["img"+i],
                    received["date"+i],
                    received["site"+i],
                    received["category"+i],
                    received["sitefoto"+i]
                ) )
            }

            for(var i=0;i<articles.length;i++)
                articles[i].createArticle()
        }
    )
}
getArticles("filtr=Dzis|wiadomosci|rmf24.pl|onet.pl|interia.pl",0)
getArticles("filtr=Dzis|wiadomosci|rmf24.pl|onet.pl|interia.pl",10)