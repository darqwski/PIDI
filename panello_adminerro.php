<!DOCTYPE>
<?php
include ("PDO.php");
session_start();
if($_SESSION['user_id']!=0)header('Location:index.php');
?>
<html>
<head>
<meta charset="UTF8"/>
<style>
body{
    background-color: black;
}
#console_out {
	display:block;
	width:99%;
	height:85%;
	background-color:#000;
	color:#0F0;
    border:3px solid #0A0;
	overflow:auto;
    font-size:300%;
}
#console_in {
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
<div id="console_out"></div>

<input id="console_in" >


<script>
document.getElementById("console_in").onkeydown=function(e)
{

	if (e.keyCode == 13) {

			document.getElementById("console_out").innerHTML+=">"+document.getElementById("console_in").value+"<br/>"
		
		 var element = document.getElementById('console_out');
				element.scrollTop = element.scrollHeight - element.clientHeight;
       if(document.getElementById("console_in").value!="rdb") $.post('console.php',{command:document.getElementById("console_in").value},function(data){
			
			
			 var element = document.getElementById('console_out');
			 element.innerHTML+=">"+data+"<br>"
				element.scrollTop = element.scrollHeight - element.clientHeight;
		});
		else if(document.getElementById("console_in").value=="rdb"){
			
			for(var i=0;i<100;i++) {

			$.get('odswiez.php?a='+i,{},function(data) {
                var element = document.getElementById('console_out');
                if (data != 'stop') {
                    element.innerHTML += ">" + data + "<br>"
                    element.scrollTop = element.scrollHeight - element.clientHeight;
                }

            })
			}
			setTimeout($.get('odswiez.php',{b:'wio'},function(data){
			    var element = document.getElementById('console_out');
				if(data!='stop') {
					element.innerHTML+=">"+data+"<br>"
					element.scrollTop = element.scrollHeight - element.clientHeight;
				}
            }), 25000);
		
			
		}
		document.getElementById("console_in").value="";
    }
}

</script>
</body>
	

	



