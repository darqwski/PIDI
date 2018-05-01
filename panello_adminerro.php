<!DOCTYPE>
<html>
<head>
<meta charset="UTF8"/>
    <style>
        body{
            background-color: black;
        }
        #consoleScreen {
            display:block;
            width:99%;
            height:85%;
            background-color:#000;
            color:#0F0;
            border:3px solid #0A0;
            overflow:auto;
            font-size:300%;
        }
        #consolePrompt {
            width:99%;
            height:10%;
            font-size:300%;
            background-color:#000;
            color:#0F0;
            border:3px solid #0A0;
        }
    </style>
<title>Panello Adminerro</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body>
<div id="consoleScreen"></div>

<input id="consolePrompt" >


<script>
    var allCommands=[];
    var commandPointer=0;
    var isLogged=false;
document.getElementById("consolePrompt").onkeydown=function(e)
{
    if(e.keyCode==38){
        document.getElementById("consolePrompt").value=allCommands[commandPointer%allCommands.length]
        commandPointer--;
    }
    if(e.keyCode==40){
        document.getElementById("consolePrompt").value=allCommands[commandPointer%allCommands.length]
        commandPointer++;
    }
    if (e.keyCode != 13) return 0;

    document.getElementById("consoleScreen").innerHTML+=">"+document.getElementById("consolePrompt").value+"<br/>"
    let element = document.getElementById('consoleScreen');
    element.scrollTop = element.scrollHeight - element.clientHeight;
    let command=document.getElementById("consolePrompt").value.toLowerCase();
   if(allCommands.top!="root"){
       allCommands.push(command)
       commandPointer++;
   }
    command=command.split(" ");

    document.getElementById("consolePrompt").value="";
    document.getElementById("consolePrompt").setAttribute("type","text");

    if(command[0]=="root"){isLogged=true;
        element.innerHTML += ">Zalogowano pomyślnie<br>"
    }
   if((command[0]!="login")&&isLogged==false){
       element.innerHTML+=">Jesteś niezalogowany <br>"
       return 0;
   }
    switch(command[0]){
        case "rdb":
            //Refreshing links one by one
            $.get('pidi/refresh.php?',{special:"special"},function(data) {
                if (data != 'stop') {
                    element.innerHTML += ">" + data + "<br>"
                    element.scrollTop = element.scrollHeight - element.clientHeight;
                }


            })

            for(let i=0;i<100;i++) {
                $.get('pidi/refresh.php?link='+i,{},function(data) {
                    if (data != 'stop') {
                        element.innerHTML += ">" + data + "<br>"
                        element.scrollTop = element.scrollHeight - element.clientHeight;
                    }


                })
            }
            //And move the table
            setTimeout($.get('pidi/refresh.php?move',{move:"move"},function(data){
                if(data!='stop') {
                    element.innerHTML+=">"+data+"<br>"
                    element.scrollTop = element.scrollHeight - element.clientHeight;
                }
            }), 45000);

            break;
        case "help":
            element.innerHTML+=">rdb - Refreshing Database<br>"
            element.innerHTML+=">rlink [number] - Refreshing single link<br>"
            element.innerHTML+=">cls - Clear Screen<br>"
            element.innerHTML+=">addrss [LINK] [CATEGORY] [SITE]- Adding new RSS to base<br>"
            element.innerHTML+=">addimg [SITE]- Adding new site image to PIDI<br>"
            element.innerHTML+="><br>"
            break;

        case "login":
            element.innerHTML+="> Podaj hasło : <br>";
            document.getElementById("consolePrompt").setAttribute("type","password");
            break;

    }


    }


</script>
</body>
	

	




