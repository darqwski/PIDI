/**
 *
 * Sends data to ASIDE and manipulate them,
 * creating a menu to choose news
 */
/**
 *
 * @param site,cat,date
 * @param 2,3,4
 */
menuTitles=[]
menuTitles["site"]="Strony Internetowe"
menuTitles["category"]="Kategorie Treści"
menuTitles["date"]="Data Dodania"
function getMenu(type,position) {

    $.get("/pidi/articlegetter.php?params="+type,function (data) {
        var received=JSON.parse(data);
        for(var i=0;i<received.length;i++) {
            if (!received[i][type]) break
            var switcher=createSwitch(received[i][type])
            var div=$("<div>",{class:"switcher-div"})
            if(type!="date")div.text(received[i][type])
            else div.text(polishTable[received[i][type]])
            var container=$("<div>",{class:"switcher-container"})
            container.append(div).append(switcher)
            $(".aside-content:nth-child("+position*2+")").append(container)
            $(".aside-header:nth-child("+(position*2-1)+")").text(menuTitles[type])
        }
    })

}


function createSwitch(value) {
    var label=$("<label>",{class:"switch"})
  //  label.text(value)
    var input=$("<input>",{type:"checkbox",name:"filtres",value:value})
    var toggler=$("<span>",{class:"slider round"})
    label.append(input).append(toggler)

 return label
}
function setButtonsValue(filtrLine){

    filtrLine=filtrLine.split("|")
    var checkboxes=document.getElementsByName("filtres")
    for(var i=0;i<checkboxes.length;i++) {
        checkboxes[i].checked=false;
    for(var i2=0;i2<filtrLine.length;i2++){
        if(checkboxes[i].value==filtrLine[i2]) {
            checkboxes[i].checked = true;

        }

        }
    }
}

var polishTable=[];
polishTable['today']="Dzisiaj"
polishTable['yesterday']="Wczoraj"
polishTable['2ago']="Przedwczoraj"
polishTable['3ago']="3 dni wstecz"
polishTable['lastweek']="Ostatni tydzień"
polishTable['previousweek']="Poprzedni tydzień"
polishTable['4ago']="4 dni wstecz"
polishTable['5ago']="5 dni wstecz"
polishTable['6ago']="6 dni wstecz"

getMenu("site",4)
getMenu("category",3)
getMenu("date",2)
setTimeout(function(){setButtonsValue("Dzis|wiadomosci|rmf24.pl|onet.pl|interia.pl")},1000)