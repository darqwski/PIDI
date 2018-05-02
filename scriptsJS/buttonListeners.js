$("#findArticles").click(function () {
    document.getElementsByTagName("container")[0].innerHTML=""
    moreArticles()
})

$(".typicalFiltres").click(function () {
    moreArticles()
    console.log("WHAT")
})
document.getElementsByClassName("mdesign")[0].onclick=function () {
    counterOfArticles=0;
    document.getElementsByTagName("container")[0].innerHTML=""
    getFiftyArticles(0,"filtr=Dzis|wiadomosci|antyradio.pl|onet.pl|rmf24.pl|interia.pl|wp.pl|kiks24.com")
    setButtonsValue("Dzis|wiadomosci|antyradio.pl|onet.pl|rmf24.pl|interia.pl|wp.pl|kiks24.com")
    setTimeout(function(){$("footer").append(moreArticlesButton)},4000)
}
document.getElementsByClassName("mdesign")[1].onclick=function () {
    counterOfArticles=0;
    document.getElementsByTagName("container")[0].innerHTML=""
    getFiftyArticles(0,"filtr=Zeszłego tygodnia|technologia")
    setTimeout(function(){$("footer").append(moreArticlesButton)},4000)

}
document.getElementsByClassName("mdesign")[2].onclick=function () {
    counterOfArticles=0;
    document.getElementsByTagName("container")[0].innerHTML=""
    getFiftyArticles(0,"filtr=Zeszłego tygodnia|joemonster.org|aszdziennik.pl")
    setButtonsValue("Zeszłego tygodnia|joemonster.org|aszdziennik.pl")
    setTimeout(function(){$("footer").append(moreArticlesButton)},4000)
}
document.getElementsByClassName("mdesign")[3].onclick=function () {
    counterOfArticles=0;
    document.getElementsByTagName("container")[0].innerHTML=""
    getFiftyArticles(0,"filtr=Dzis|wiadomosci|humor|technologia|kultura|filmweb.pl|antyradio.pl|joemonster.org|moviesroom.pl|rmf24.pl|kiks24.com")
    setButtonsValue("Dzis|wiadomosci|humor|technologia|kultura|filmweb.pl|antyradio.pl|joemonster.org|moviesroom.pl|rmf24.pl|kiks24.com")
    setTimeout(function(){$("footer").append(moreArticlesButton)},4000)}
$(".top-aside").click(function () {

    $(".bottom-aside").toggle(500)
})
function moreArticles(){
    counterOfArticles+=50
    getFiftyArticles(counterOfArticles,getCommand())
    setTimeout(function(){$("footer").append(moreArticlesButton)},4000)

}