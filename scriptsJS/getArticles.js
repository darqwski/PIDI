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
    var link="/pidi/articlegetter.php?"+filtrLine+"&count="+(counter);
    $.get(link,function(data) {
            console.log(link)
            try{received=JSON.parse(data)}
            catch (error){
                console.log(link)
                console.log(data);
            }
            for(var i=0;i<10;i++)
            {
                if(!received[i]["title"])break
                articles[articles.length]=(new article(
                    received[i]["title"].replace("&qout;","\""),
                    received[i]["link"],
                    received[i]["img"],
                    received[i]["date"],
                    received[i]["site"],
                    received[i]["category"],
                    received[i]["sitefoto"]
                ) )
            }

            for(var i=0;i<articles.length;i++)
                articles[i].createArticle()
        }
    )
}
getArticles("filtr=Dzis|wiadomosci|rmf24.pl|onet.pl|interia.pl",0)
getArticles("filtr=Dzis|wiadomosci|rmf24.pl|onet.pl|interia.pl",10)