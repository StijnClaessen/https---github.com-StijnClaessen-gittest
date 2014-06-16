<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="themes/base/jquery.ui.all.css">

	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
	<script src="ui/jquery.ui.core.js"></script>
	<script src="ui/jquery.ui.widget.js"></script>
	<script src="ui/jquery.ui.datepicker.js"></script>
        <script src="js/jquery-ui-timepicker-addon.js"></script>
        <script src="js/jquery.ui.slider.js"></script>
        <link rel="css/jquery-ui-timepicker-addon.css">
        <link rel="css/jquery-ui.css">
        <link rel="css/jquery.ui.slider.css">
        <link href='http://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
        
        <script>
            
            
	$(function() {
            
        var startDateTextBox = $('#starttime');
var endDateTextBox = $('#endtime');

startDateTextBox.datetimepicker({ 
	timeFormat: 'HH:mm',
        dateFormat:'dd/mm/yy',
        showTimezone:false,
        timezone:false,
        timezoneText:false,
	onClose: function(dateText, inst) {
		if (endDateTextBox.val() != '') {
			var testStartDate = startDateTextBox.datetimepicker('getDate');
			var testEndDate = endDateTextBox.datetimepicker('getDate');
			if (testStartDate > testEndDate)
				endDateTextBox.datetimepicker('setDate', testStartDate);
		}
		else {
			endDateTextBox.val(dateText);
		}
	},
	onSelect: function (selectedDateTime){
		endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
	}
});
endDateTextBox.datetimepicker({ 
	timeFormat: 'HH:mm',
        dateFormat:'dd/mm/yy',
        showTimezone:false,
        timezone:false,       
	onClose: function(dateText, inst) {
		if (startDateTextBox.val() != '') {
			var testStartDate = startDateTextBox.datetimepicker('getDate');
			var testEndDate = endDateTextBox.datetimepicker('getDate');
			if (testStartDate > testEndDate)
				startDateTextBox.datetimepicker('setDate', testEndDate);
		}
		else {
			startDateTextBox.val(dateText);
		}
	},
	onSelect: function (selectedDateTime){
		startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
	}
});

//timer actions
            $("#btn").click(function(){
                switch($(this).html().toLowerCase())
                {
                    case "start":
                        s = parseInt($("input[name='s']").val());
                        if(isNaN(s))
                        {
                            s = 0;
                            $("input[name='s']").val(0);
                        }
                        //you can specify action via object or a string
                        $("#t").timer({
                            action: 'start', 
                            seconds:s
                        });
                        $(this).html("Pause");
                        $("input[name='s']").attr("disabled", "disabled");
                        $("#t").addClass("badge-important");
                        break;
                    
                    case "resume":
                        //you can specify action via string
                        $("#t").timer('resume');
                        $(this).html("Pause")
                        $("#t").addClass("badge-important");
                        break;
                    
                    case "pause":
                        //you can specify action via object
                        $("#t").timer({action: 'pause'});
                        $(this).html("Resume")
                        $("#t").removeClass("badge-important");
                        break;
                }
            });
            
            $("#get-seconds-btn").click(function(){
                console.log($("#t").timer("get_seconds"));
            });

});
	</script>
        
        <script language="JavaScript">
var startTime = 0
var start = 0
var end = 0
var diff = 0
var timerID = 0
function chrono(){
	end = new Date()
	diff = end - start
	diff = new Date(diff)
	var msec = diff.getMilliseconds()
	var sec = diff.getSeconds()
	var min = diff.getMinutes()
	var hr = diff.getHours()-1
	if (min < 10){
		min = "0" + min
	}
	if (sec < 10){
		sec = "0" + sec
	}
	if(msec < 10){
		msec = "00" +msec
	}
	else if(msec < 100){
		msec = "0" +msec
	}
	document.getElementById("chronotime").innerHTML = hr + ":" + min + ":" + sec + ":" + msec
	timerID = setTimeout("chrono()", 10)
}
function chronoStart(){
	document.chronoForm.startstop.value = "stop!"
	document.chronoForm.startstop.onclick = chronoStop
	document.chronoForm.reset.onclick = chronoReset
	start = new Date()
        var month = start.getMonth()+1
        var day = start.getDate()
        var year = start.getFullYear()
        var hour = start.getHours()
        var minutes = start.getMinutes()
        var seconds = start.getSeconds()
        if (day < 10){
		day = "0" + day
	}
	if (hour < 10){
		hour = "0" + hour
	}
	if(minutes < 10){
		minutes = "0" + minutes
	}
        if(month < 10){
		month = "0" + month
	}
        if(seconds < 10){
                seconds = "0" + seconds
        }
        document.chronoForm.starttime.value = day + '/'+ month + '/' + year +' '+hour+':'+minutes+':'+seconds
        document.chronoForm.endtime.value = day + '/'+ month + '/' + year +' '+hour+':'+minutes+':'+seconds
	chrono()
}
function chronoContinue(){
	document.chronoForm.startstop.value = "stop!"
	document.chronoForm.startstop.onclick = chronoStop
	document.chronoForm.reset.onclick = chronoReset
	start = new Date()-diff
	start = new Date(start)
	chrono()
}
function chronoReset(){
	document.getElementById("chronotime").innerHTML = "0:00:00:000"
	start = new Date()
}
function chronoStopReset(){
	document.getElementById("chronotime").innerHTML = "0:00:00:000"
	document.chronoForm.startstop.onclick = chronoStart
}
function chronoStop(){
	document.chronoForm.startstop.value = "start!"
	document.chronoForm.startstop.onclick = chronoStart
        	start = new Date()
        var month = start.getMonth()+1
        var day = start.getDate()
        var year = start.getFullYear()
        var hour = start.getHours()
        var minutes = start.getMinutes()
        var seconds = start.getSeconds()
                if (day < 10){
		day = "0" + day
	}
	if (hour < 10){
		hour = "0" + hour
	}
	if(minutes < 10){
		minutes = "0" + minutes
	}
        if(month < 10){
		month = "0" + month
	}
        if(seconds < 10){
                seconds = "0" + seconds
        }
        document.chronoForm.endtime.value = day + '/'+ month + '/' + year +' '+hour+':'+minutes+':'+seconds
	clearTimeout(timerID)
}
//-->
</script>
        		<style type="text/css"> 
			body,img,p,h1,h2,h3,h4,h5,h6,form,table,td,ul,ol,li,dl,dt,dd,pre,blockquote,fieldset,label{
				margin:10;
				padding:0;
				border:0;
			}
			h1,h2,h3{ margin: 10px 0; font-family: 'Arimo', sans-serif;}
			h1{}
			h2{ color: #f66; }
			h3{ color: #6b84a2; }
			p{ margin: 10px 0; }
			a{ color: #7b94b2; }
			ul,ol{ margin: 10px 0 10px 40px; }
			li{ margin: 4px 0; }
			dl.defs{ margin: 10px 0 10px 40px; }
			dl.defs dt{ font-weight: bold; line-height: 20px; margin: 10px 0 0 0; }
			dl.defs dd{ margin: -20px 0 10px 160px; padding-bottom: 10px; border-bottom: solid 1px #eee;}
			pre{ font-size: 12px; line-height: 16px; padding: 5px 5px 5px 10px; margin: 10px 0; background-color: #e4f4d4; border-left: solid 5px #9EC45F; overflow: auto; tab-size: 4; -moz-tab-size: 4; -o-tab-size: 4; -webkit-tab-size: 4; }

			.wrapper{ background-color: #ffffff; width: 800px; border: solid 1px #eeeeee; padding: 20px; margin: 0 auto; }
			#tabs{ margin: 20px -20px; border: none; }
			#tabs, #ui-datepicker-div, .ui-datepicker{ font-size: 85%; }
			.clear{ clear: both; }

		</style>
    </head>
    <body>     
        <?php
        
        include 'classes/Registration.php';
        include 'classes/dal.php';
        include_once 'classes/IRegistration.php';
        include 'dbconnect.php';
        // put your code here
        
        if(!$_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $buttonValue = 'start';
        }
         
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            {
                $registratie = new Registration();
                $registratie->setStartTime($_POST['starttime']);
                $registratie->setEndTime($_POST['endtime']);
                $starttime = $registratie->getStartTime();
                $endtime = $registratie->getEndTime();
                print "Je starttijd is " .$starttime;
                print("<br />");
                print "Je eindtijd is " .$endtime;
                print('<br />'); 
                $timediff = ($registratie->getTimeDiffHoursMinSec($starttime, $endtime));
                print ('Totale tijd is '.$timediff);
                print('<br />');
                $dal = new dal();
                $dal->insertRegistration($starttime, $endtime, $timediff); 
            }
         
        ?>
                
         <form method="post" id="theForm" action="index.php" name="chronoForm">
             <table border="0" cellpadding="0" cellspacing="0">
                 <tr><td>Starttijd : </td><td><input type="text" name="starttime" id="starttime" value="" /></td></tr>
             <tr><td>Eindtijd : </td><td><input type="text" name="endtime" id="endtime" value="" /></td></tr></table>
            <br /> 
            <p>
            <input type="submit" name="submit" value="registreer" class='ui-button ui-widget ui-state-default ui-corner-all'>
            </p>
            <br />
            <br />
            <span id="chronotime">0:00:00:00</span><br />
            <input type="button" name="startstop" value="start!" onClick="chronoStart()" />
    <input type="button" name="reset" value="reset!" onClick="chronoReset()" /><br /><br />
    
            <a href="Registrations.php">Bekijk Registraties</a>
        </form>
    </body>
</html>
