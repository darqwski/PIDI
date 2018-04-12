$("#findArticles").click(function () {
    document.getElementsByTagName("container")[0].innerHTML=""
    getFiftyArticles(counterOfArticles,getCommand())
    counterOfArticles+=50

})

$(".typicalFiltres").click(function () {
    document.getElementsByTagName("container")[0].innerHTML=""
    getFiftyArticles(counterOfArticles,getCommand())
    counterOfArticles+=50

})
document.getElementsByClassName("mdesign")[0].onclick=function () {
    document.getElementsByTagName("container")[0].innerHTML=""
    getFiftyArticles(counterOfArticles,"filtr=Dzis|wiadomosci|antyradio.pl|onet.pl|rmf24.pl|interia.pl|wp.pl|kiks24.com")
    setButtonsValue("Dzis|wiadomosci|antyradio.pl|onet.pl|rmf24.pl|interia.pl|wp.pl|kiks24.com")

    counterOfArticles+=50
}
document.getElementsByClassName("mdesign")[1].onclick=function () {
    document.getElementsByTagName("container")[0].innerHTML=""
    getFiftyArticles(counterOfArticles,"filtr=Zeszłego tygodnia|technologia")
    counterOfArticles+=50
}
document.getElementsByClassName("mdesign")[2].onclick=function () {
    document.getElementsByTagName("container")[0].innerHTML=""
    getFiftyArticles(counterOfArticles,"filtr=Zeszłego tygodnia|joemonster.org|aszdziennik.pl")
    setButtonsValue("Zeszłego tygodnia|joemonster.org|aszdziennik.pl")

    counterOfArticles+=50
}
document.getElementsByClassName("mdesign")[3].onclick=function () {
    document.getElementsByTagName("container")[0].innerHTML=""
    getFiftyArticles(counterOfArticles,"filtr=Dzis|wiadomosci|humor|technologia|kultura|filmweb.pl|antyradio.pl|joemonster.org|moviesroom.pl|rmf24.pl|kiks24.com")
    setButtonsValue("Dzis|wiadomosci|humor|technologia|kultura|filmweb.pl|antyradio.pl|joemonster.org|moviesroom.pl|rmf24.pl|kiks24.com")
    counterOfArticles+=50
}
$(".top-aside").click(function () {

    $(".bottom-aside").toggle(500)
})