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
menuTitles["cat"]="Kategorie Treści"
menuTitles["date"]="Data Dodania"
function getMenu(type,position) {

    $.get("http://darqwski.cba.pl/PIDI/antek.php?gimmi="+type,function (data) {
        var received=JSON.parse(data);
        for(var i=0;i<received.number;i++) {
            if (!received["item" + i]) break
            var switcher=createSwitch(received["item"+i])
            var div=$("<div>",{class:"switcher-div"}).text(received["item"+i])
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

    console.log(filtrLine)
    filtrLine=filtrLine.split("|")
    console.log(filtrLine)
    var checkboxes=document.getElementsByName("filtres")
    for(var i=0;i<checkboxes.length;i++) {
        checkboxes[i].checked=false;
    for(var i2=0;i2<filtrLine.length;i2++){
        if(checkboxes[i].value==filtrLine[i2]) {
            checkboxes[i].checked = true;
            console.log(checkboxes[i].value)

        }

        }
    }
}
getMenu("site",4)
getMenu("cat",3)
getMenu("date",2)
setTimeout(function(){setButtonsValue("Dzis|wiadomosci|rmf24.pl|onet.pl|interia.pl")},1000)