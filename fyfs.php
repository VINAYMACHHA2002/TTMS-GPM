<!--
PRIORITY 1 HAS 4 ACTUAL AND 2 EXTRA LECTURE FROM 1A TO 1F
PRIORITY 2 HAS 3 ACTUAL AND 2 EXTRA LECTURE FROM 2A TO 2E
PRIORITY 3 HAS 3 ACTUAL AND 1 EXTRA LECTURE FROM 3A TO 3D
PRIORITY 4 HAS 3 ACTUAL AND 1 EXTRA LECTURE FROM 4A TO 4D
PRIORITY 5 HAS 2 ACTUAL AND 2 EXTRA LECTURE FROM 5A TO 5D
--><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>FIRST YEAR FIRST SHIFT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">


	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-colorpicker.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">


 <style>
 .tm,.tm2,.structtd{font-size:4pt;width:10%;text-align:center;
    white-space: nowrap; padding:0px !important; } 
    .maintbl td:not(.tm):not(.structtd),.maintbl th:not(.tm2){vertical-align:middle !important; text-align:center; width:18%}
  .table>tfoot>tr>td.tm{padding:0px;}
  th{text-align:center; width:0px;padding:0px;}
  .structtd{width:0%;padding:0px !important; border:0px;}
  td:hover {
background-color: rgba(37, 253, 8, 0.22);
}
.tab{
  border-collapse: collapse;
	width:100%;
	border: 1px solid black;
}
.wrapper1{
		padding: 20px; 
		margin-top:-500px;
		margin-left:950px;
		}
.used{}
.dangerRem{background-color:rgba(255, 0, 0, 0.46);}
.softDanger{background-color:rgba(255, 0, 0, 0.20);}
 </style>
<script type="text/javascript">
	 courses={};
function slotexpand(slotnames){
	slotnames=slotnames.replace(/[\s]/ig,"").toUpperCase().replace("LX","Lx");
	var finalslots=[];
	var slotlist=slotnames.split(/[;,]/ig);
	for (i in slotlist){
		var currslot=slotlist[i];
		switch (currslot){
			case "1":
			case "2":
			case "3":
			case "4":
				finalslots=finalslots.concat([currslot+"A",currslot+"B",currslot+"C"]);
				break;
			case "5":
			case "6":
			case "7":
			case "8":
			case "9":
			case "10":
			case "11":
			case "12":
			case "13":
			case "14":
			case "15":
				finalslots=finalslots.concat([currslot+"A",currslot+"B"]);
				break;				
			default:
				finalslots.push(currslot);
		}
	}
	return finalslots;
}
 function addCourse(coursename,slots,venue,color){
	 console.log(color);
	 eslots=slotexpand(slots);
	 
	 slotid=coursename+"-"+eslots.join("-");
	 slotid="i-"+slotid.replace(/[^A-Za-z0-9\-\_\:\.]/ig,'-');
	courses[slotid]={"name":coursename,"slots":eslots,"venue":venue, "color" : color};
	for(aslot in eslots){
		if($('.slot-'+eslots[aslot]).length<=0){
			alert("Slot "+eslots[aslot]+" does not exist");
			return false;
		}
	}
	
	 for (aslot in eslots){
		 eslots[aslot]=new String(eslots[aslot]);
		if($('.slot-'+eslots[aslot]+'.used').length>0||$('.slot-clash-'+eslots[aslot]+'.used').length>0){
			 var arr=$('.slot-'+eslots[aslot]+'.used,.slot-clash-'+eslots[aslot]+'.used').map(function(){return $(this).find('.slot-name').html()+" ("+$(this).find('.course-name').html()+")"}).get()
			 var arr2=$('.slot-'+eslots[aslot]+'.used,.slot-clash-'+eslots[aslot]+'.used').map(function(){return $(this).find('.course-name').html()}).get()
			$('.course-name').each(function(){if(arr2.indexOf(this.innerHTML)!=-1){$(this).parents(".used").addClass('softDanger')}})
			$('.slot-'+eslots[aslot]+'.used,.slot-clash-'+eslots[aslot]+'.used').addClass('dangerRem').removeClass("softDanger")
			eslots[aslot].nooverwrite=!confirm("Slot clash of "+eslots[aslot]+" with "+arr.join(", ")+", overwrite other course or cancel this one?");
			$('.used').removeClass('dangerRem').removeClass('softDanger')
			if(!eslots[aslot].nooverwrite){
				$('.slot-'+eslots[aslot]+'.used,.slot-clash-'+eslots[aslot]+'.used').each(function(){$('.rmslot[data-slotid='+$(this).data('slotid')+']').click()});
			}else{
				delete courses[slotid];
				return true;
			}
		}
	 }
	 
	 for (aslot in eslots){
		 console.log(eslots[aslot]+" "+eslots[aslot].overwrite)
		if(!eslots[aslot].nooverwrite){
			showSlot(eslots[aslot],true,color);
			var $slot=$('.slot-'+eslots[aslot]);
			$slot.find('.course-name').html(coursename);
			$slot.find('.course-venue').html(venue);
			$slot.data('slotid',slotid)
		}
	 }
	 $('<tr id="list-'+slotid+'"><td><button type="button" class="btn btn-default btn-xs list-'+slotid+' " id="color-button-'+slotid+'"><span class="glyphicon glyphicon-pencil"></span></button></td><td id="list-name-'+slotid+'">'+coursename+'</td><td><button class="rmslot  btn-xs btn btn btn-danger" data-slotid="'+slotid+'">x</button></td></tr>').appendTo('#listb')
	$('#color-button-' + slotid).attr('style', 'background-color:'+color+' !important')
	.colorpicker({format: "rgba", color:color}).on('changeColor', function(ev){
		var rgbc = ev.color.toRGB();
		var rgbc_str = "rgba("+rgbc.r + "," + rgbc.g + "," + rgbc.b + ",0.36)";
		courses[slotid].color = rgbc_str;
		for (aslot in eslots){
			if(!eslots[aslot].nooverwrite){
				$('.slot-'+eslots[aslot]).attr('style', 'background-color:'+rgbc_str+' !important');
			}
		 }
		 updatePerma()
		 $('#color-button-' + slotid).attr('style', 'background-color:'+rgbc_str+' !important');
	});
	 updatePerma()
	 $("#inputrow input:not(#color)").val("");
	 // 	$("#color").val("rgba(255, 255, 0, 0.36)"); // the previous used default color
 }
 

function updatePerma(){
	$('#perma').attr('href','?timetable='+encodeURIComponent(btoa(JSON.stringify(courses)))+"&slots="+$('#snametog').hasClass('active'));
	return $('#perma').attr('href');
}
 function showSlot(slotname,use,color){
	 $('.slot-'+slotname).show();
	 if(use){$('.slot-'+slotname).attr('style', 'background-color:'+color+' !important')
                               .addClass('used');}
	 $('.clashbuddy-'+slotname).show();
	 $('.slot-clash-'+slotname).hide();
 }
 function hideSlot(slotname,unuse){

	 if(unuse){$('.slot-'+slotname).removeClass('used')
			                           .attr('style', 'background-color:white !important');}

	 if($('.clashbuddy-'+slotname+".used").length==0&&$('.clashbuddy-'+slotname).length!=0){
		$('.slot-'+slotname).hide();
		$('.clashbuddy-'+slotname).hide();
		$('.slot-clash-'+slotname).show();	 		 
	 }

 }
 function toggleSlot(){
 $('#snametog').toggleClass('active')
	if($('#snametog').hasClass('active')){
	  $('.slot-name').show();
	  $('#snametog').html('Hide slot names');
	}else{
		$('.slot-name').hide();
		$('#snametog').html('Show slot names');
	};
  $('#snametog').blur();
  updatePerma();
  }
 function getJsonFromUrl() {
	 //From http://stackoverflow.com/a/8486188/1198729, by user Jan Turon
  var query = location.search.substr(1);
  var data = query.split("&");
  var result = {};
  for(var i=0; i<data.length; i++) {
    var item = data[i].split("=");
    result[item[0]] = item[1];
  }
  return result;
}

function printable(){
	history.pushState({},"",updatePerma())
	if(confirm("Remove colors?")){
		$('.used').css('background-color','white')
	}
	$('body').html($('.maintbl').parent().html())
}

function validateICS()
{
	$('#icsForm').html(''); //clean
	$('.maintbl').find('td').each(function(){
	if($(this).hasClass("used"))
	{
		var slot = $(this).find('.slot-name').text();
		var venue = $(this).find('.course-venue').text();
		var course = $(this).find('.course-name').text();
		$('<input type = "hidden" name = "slot[]" value = "'+slot+'" />').appendTo($('#icsForm'));
		$('<input type = "hidden" name = "venue[]" value = "'+venue+'" />').appendTo($('#icsForm'));
		$('<input type = "hidden" name = "course[]" value = "'+course+'" />').appendTo($('#icsForm'));
	}
	});
	$('#icsForm').submit();
}

 </script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/bootstrap-colorpicker.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>
<script>
$(document).ready(function(){
	$('#listb').on('click','.rmslot',function(){
	var slotid=$(this).data('slotid');
	 slotid=slotid.replace(/\s/ig,'-');
	var slots=courses[slotid].slots;
	for(i in slots){
		//hideSlot(slots[i],true);
		var $slot=$('.slot-'+slots[i]);
		$slot.find('.course-name').html("");
		$slot.find('.course-venue').html("");
		$slot.removeClass('used');
		$slot.attr('style', 'background-color:white !important')
	}
  $('.list-' + slotid).colorpicker('destroy');
	$('#list-'+slotid).remove();
	delete courses[slotid];
	updatePerma();
});
lspl=getJsonFromUrl();
if(lspl["data"]&&lspl["data"].length>0){
	var courses2=JSON.parse(decodeURIComponent(lspl["data"]));
	for(i in courses2){
		if (!courses2[i].color) {
			courses2[i].color = "rgba(255, 255, 0, 0.36)";
		}
		addCourse(courses2[i].name,courses2[i].slots.join(";"),courses2[i].venue,courses2[i].color);
	}

}
if(lspl["timetable"]&&lspl["timetable"].length>0){
	var courses2=JSON.parse(atob(decodeURIComponent(lspl["timetable"])));
	for(i in courses2){
		if (!courses2[i].color) {
			courses2[i].color = "rgba(255, 255, 0, 0.36)";
		}
		addCourse(courses2[i].name,courses2[i].slots.join(";"),courses2[i].venue,courses2[i].color);
	}

}
if(lspl["slots"]&&lspl["slots"]=="false"){

	toggleSlot();
}
	updatePerma();
	
	$('#helpicon').popover({"title":"Separate multiple slots with a comma. <br>Slot groups like '4' also allowed","trigger":"hover","html":true,"placement":"bottom"});
	$('.structtd').html('<br><br>');
  $('.picker').colorpicker({format: "rgba"}).on('changeColor', function(ev){
		var ev_rgb = ev.color.toRGB();
		var alpha = ev_rgb.a
		if (alpha === 1) { alpha = 0.36; }
		var ev_str = "rgba("+ev_rgb.r+","+ev_rgb.g+","+ev_rgb.b+","+alpha+")";
		$("#color").val(ev_str);
	});
	$('.maintbl td').dblclick(function () {
	    var $this = $(this);
	    if($("#cslots").val()==""){
	    	$("#cslots").val($this.find("span").first().text());
	    }
	    else{
	    	var text=$("#cslots").val();
	    	text=text + "," + $this.find("span").first().text();
	    	$("#cslots").val(text);
	    }
	});

});
</script>	


<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<h3>
				Timetable creator (FYFS)
			</h3>
		</div>
	</div>
	<marquee> <u><b>PRACTICALS AFTER 12:00PM SHOULD BE STRICTLY TAKEN IN 302/301 LABS <b><u></marquee>
	<marquee> <u><b>SLOTS HAVING PRIORITIES WITH E AND F ARE EXTRA SLOTS KEPT FOR EXTRA LECTURES<b><u></marquee>
	<div class="row clearfix">
		<div class="col-md-10 column">
		<div class="row clearfix" id="inputrow">
		<div class="col-md-2 column"><input type=text class="form-control" id=ccode placeholder="Course and Teacher Name"/></div>
		<div class="col-md-2 column"><div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-question-sign" data-toggle="tooltip"  id="helpicon"></i></span>
			<input type=text class="form-control" id=cslots placeholder="Slots"/>
		</div></div>
		<div class="col-md-2 column"><input type=text class="form-control" id=cvenue placeholder="Venue"/></div>
    <div class="col-md-2 column input-group picker">
        <input type="text" placeholder="BG color" id=color value="rgba(255, 255, 0, 0.36)" class="form-control" />
        <span class="input-group-addon"><i></i></span>
    </div>
		<div class="col-md-1 column"><button class="btn btn-primary" onclick="addCourse($('#ccode').val(),$('#cslots').val(),$('#cvenue').val(), $('#color').val())">Add</button></div>
		<div class="col-md-2 column"><button class="btn btn-default togglebtn active" id=snametog onclick="toggleSlot()">Hide slot names</button></div>

		</div>
		<div class="row">&nbsp;</div> 
		<div class="row clearfix">
		<div class="col-md-12 column">
			<table class="table table-bordered maintbl">
				<thead>
					<tr>
						<th colspan=3 class=tm2 style="width:10% ; font-size: 20px" >
							Day
						</th>
						<th>
							08:00 - 09:00
						</th>
						<th>
							09:00 - 10:00
						</th>
						<th>
							10:00 - 11:00
						</th>
						<th>
							11:00 - 12:00
						</th>
						<th style="width:10%">
							12:00 - 12:30
						</th>
						<th>
							12:30 - 01:30
						</th>
						<th>
							01:30 - 02:30
						</th>
						<th>
							02:30 - 03:30
						</th>
						<th>
						 	03:30 - 04:30
						</th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td class=structtd></td>
					<td colspan=2 class="tm" style="font-size:15px; width:100px">
						Monday
					</td>
					<td class="slot-1 slot-1E"><span class="slot-name">1E</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-2 slot-2E"><span class="slot-name">2E</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td colspan="2"><table style="border-collapse: collapse; width:100%"><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-1 slot-PL1A"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>A</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-5 slot-PL5B"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>B</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-2 slot-PL2C"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>C</td></tr></table></td>
					<td rowspan="6">BREAK</td>
					<td class="slot-6 slot-6A"><span class="slot-name">6A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-1 slot-1A"><span class="slot-name">1A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-4 slot-4F"><span class="slot-name">4F</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
				</tr>
				<tr>
					<td class=structtd></td>
					<td class=tm colspan="2" style="font-size:15px">
						Tuesday
					</td>
					<td class="slot-1 slot-1A"><span class="slot-name">1A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-2 slot-2A"><span class="slot-name">2A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td colspan="2" ><table style="border-collapse: collapse; width:100%"><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-2 slot-PL2A"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>A</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-4 slot-PL4B"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>B</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-4 slot-PL4C"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>C</td></tr></table></td>
					<td class="slot-6 slot-6A"><span class="slot-name">6A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-3 slot-3A"><span class="slot-name">3A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-3 slot-3A"><span class="slot-name">3A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
				</tr>
				<tr>
					<td class=structtd></td>
					<td class=tm colspan="2" style="font-size:15px">
						Wednesday
					</td>
					<td class="slot-2 slot-2F"><span class="slot-name">2F</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-2 slot-2A"><span class="slot-name">2A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td colspan="2" ><table style="border-collapse: collapse; width:100%"><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-2 slot-PL2A"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>A</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-1 slot-PL1B"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>B</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-2 slot-PL2C"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>C</td></tr></table></td>
					<td colspan="2" ><table style="border-collapse: collapse; width:100%"><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-4 slot-PL4A"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>A</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-3 slot-PL3B"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>B</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-4 slot-PL4C"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>C</td></tr></table></td>
					<td class="slot-1 slot-1F"><span class="slot-name">1F</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
				</tr>
				<tr>
					<td class=structtd></td>
					<td class=tm colspan="2" style="font-size:15px">
						Thursday
					</td>
					<td class="slot-6 slot-6A"><span class="slot-name">6A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-5 slot-5A"><span class="slot-name">5A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td colspan="2"><table style="border-collapse: collapse; width:100%"><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-4 slot-PL4A"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>A</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-2 slot-PL2B"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>B</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-5 slot-PL5C"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>C</td></tr></table></td>
					<td colspan="2"><table style="border-collapse: collapse; width:100%"><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-3 slot-PL3A"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>A</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-4 slot-PL4B"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>B</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-1 slot-PL1C"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>C</td></tr></table></td>
					<td class="slot-3 slot-3E"><span class="slot-name">3E</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
				</tr>
				<tr>
					<td class=structtd></td>
					<td class=tm colspan="2" style="font-size:15px">
						Friday
					</td>
					<td class="slot-3 slot-3F"><span class="slot-name">3F</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-5 slot-5A"><span class="slot-name">5A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-1 slot-1A"><span class="slot-name">1A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-6 slot-6A"><span class="slot-name">6A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td colspan="2"><table style="border-collapse: collapse; width:100%"><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-5 slot-PL5A"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>A</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-2 slot-PL2B"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>B</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="slot-3 slot-PL3C"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>C</td></tr></table></td>
					<td class="slot-1 slot-1D"><span class="slot-name">1D</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
				</tr>
				<tr>
					<td class=structtd></td>
					<td class=tm colspan="2" style="font-size:15px">
						Saturday
					</td> 
					<td colspan="4"><table style="border-collapse: collapse; width:100%"><tr><td style= "border-bottom: 1px solid #ddd;" class="#"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>A</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="#"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>B</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="#"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>C</td></tr></table></td>
					<td colspan="4"><table style="border-collapse: collapse; width:100%"><tr><td style= "border-bottom: 1px solid #ddd;" class="#"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>A</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="#"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>B</td></tr><tr><td style= "border-bottom: 1px solid #ddd;" class="#"><span class="slot-name"></span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div>C</td></tr></table></td>
				</tr>
				<!--
				<tr>
					<td class=structtd></td>
					<td class=tm rowspan=2>
						11:00-<br>12:25
					</td>
					<td class="slot-6 slot-6A slot-clash-L5 clashbuddy-5A" rowspan=2><span class="slot-name">6A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-6 slot-6B slot-clash-L6 clashbuddy-6A" rowspan=2><span class="slot-name">6B</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>

				</tr>				
				<tr>
					<td class=structtd></td>
					<td class=tm >
						11:35-<br>12:30
					</td>
					<td class="slot-4 slot-4A slot-clash-LM clashbuddy-2A clashbuddy-3A"><span class="slot-name">4A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-3 slot-3B slot-clash-LT clashbuddy-1B clashbuddy-2B"><span class="slot-name">3B</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-2 slot-2C slot-clash-LH clashbuddy-4C clashbuddy-1C"><span class="slot-name">2C</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>

				</tr>		
				<tr>
					<td class=structtd></td>
					<td colspan=2 class=tm>12:30-<br>2:00</td>
					<td colspan=42 style="text-align:center">Lunch</td>
				</tr>		
				<tr>
					<td class=structtd></td>
					<td class=tm>2:00-<br>2:55</td>
					<td class=tm rowspan=2>2:00-<br>3:25</td>
					<td class="slot-8 slot-8A slot-clash-L1 clashbuddy-9A" rowspan=2><span class="slot-name">8A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-L1 slot-clash-9A slot-clash-8A" style="display:none" rowspan=4><span class="slot-name">L1</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>		
					<td class="slot-10 slot-10A slot-clash-L2 clashbuddy-11A" rowspan=2><span class="slot-name">10A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-L2  slot-clash-10A slot-clash-11A" style="display:none" rowspan=4><span class="slot-name">L2</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>		
					<td class="slot-X slot-X1 slot-clash-Lx clashbuddy-X2 clashbuddy-X3" style="display:none"><span class="slot-name">X1</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					
					<td class="slot-Lx slot-clash-X slot-clash-X1 slot-clash-X2 slot-clash-X3"  rowspan=4><span class="slot-name">Lx</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-8 slot-8B slot-clash-L3 clashbuddy-9B" rowspan=2><span class="slot-name">8B</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-L3 slot-clash-8B slot-clash-9B" style="display:none" rowspan=4><span class="slot-name">L3</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>		
					<td class="slot-10 slot-10B slot-clash-L4 clashbuddy-11B" rowspan=2><span class="slot-name">10B</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-L4 slot-clash-10B slot-clash-11B" style="display:none" rowspan=4><span class="slot-name">L4</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>		
				</tr>
				<tr>
					<td class=structtd></td>
					<td class=tm rowspan=2>3:00-<br>3:55</td>
					<td class="slot-X slot-X2 slot-clash-Lx clashbuddy-X1 clashbuddy-X3" style="display:none" rowspan=2><span class="slot-name">X2</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>

				</tr>
				<tr>
					<td class=structtd></td>
					<td class=tm rowspan=2>3:30-<br>4:55</td>
					<td class="slot-9 slot-9A slot-clash-L1 clashbuddy-8A" rowspan=2><span class="slot-name">9A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-11 slot-11A slot-clash-L2 clashbuddy-10A" rowspan=2><span class="slot-name">11A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					
					<td class="slot-9 slot-9B slot-clash-L3 clashbuddy-8B" rowspan=2><span class="slot-name">9B</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-11 slot-11B slot-clash-L4 clashbuddy-10B" rowspan=2><span class="slot-name">11B</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>

				</tr>
				<tr>
					<td class=structtd></td>
					<td class=tm>4:00-<br>4:55</td>
					<td class="slot-X slot-X3 slot-clash-Lx  clashbuddy-X2 clashbuddy-X1" style="display:none"><span class="slot-name">X3</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>

				</tr>
                <tr>
                    <td class=structtd></td>
                    <td colspan=2 class=tm>5:00-<br>5:30</td>
                    <td colspan=42 style="text-align:center">Tiffin</td>
                </tr>   
				<tr>
					<td class=structtd></td>
					<td class=tm colspan=2>5:30-<br>7:00</td>
					<td class="slot-12 slot-12A"><span class="slot-name">12A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-14 slot-14A"><span class="slot-name">14A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-X slot-XC"><span class="slot-name">XC</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-12 slot-12B"><span class="slot-name">12B</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-14 slot-14B"><span class="slot-name">14B</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>

				</tr>
				<tr>
					<td class=structtd></td>
					<td class=tm colspan=2>7:05-<br>8:30</td>
					<td class="slot-13 slot-13A"><span class="slot-name">13A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-15 slot-15A"><span class="slot-name">15A</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-X slot-XD"><span class="slot-name">XD</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-13 slot-13B"><span class="slot-name">13B</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>
					<td class="slot-15 slot-15B"><span class="slot-name">15B</span><div class="slot-deets"><span class="course-name"></span><div class="course-venue"></div></div></td>

				</tr>
				
				
				</tbody> -->
			</table>
		</div>
		</div>
		</div>
		<div class="col-md-2 column"><br><br><br><br>
			<button class="btn btn-default form-control"  style="z-index:2" onclick="printable()">Printable</button>
		</div>
	</div>
	<div class=row>
	</div>
	
	
	<div class="wrapper1">
<table class="tab">
<tr class="tab">
<th class="tab">
PRIORITY
</th>
<th class="tab">
No. of LEC
</th>
<th class="tab">
No. of PRAC
</th>
</tr>
<tr class="tab">
<td class="tab">
1A
</td>
<td class="tab">
4
</td>
<td class="tab">
3
</td>
</tr>
<tr class="tab">
<td class="tab">
2A
</td>
<td class="tab">
3
</td>
<td class="tab">
3
</td>
</tr>
<tr class="tab">
<td class="tab">
3A
</td>
<td class="tab">
3
</td>
<td class="tab">
3
</td>
</tr>
<tr class="tab">
<td>
4A
</td>
<td class="tab">
3
</td>
<td class="tab">
3
</td>
</tr>
<tr class="tab">
<td class="tab">
5A
</td>
<td class="tab">
2
</td>
<td class="tab">
3
</td>
</tr>
</table>
<br>
<?php
include("config.php");
$a ="SELECT * FROM `teacherfs` ";
$rows = $link->query($a);
echo "<table border='1px' color='black' style='padding:4px' border='collapse'>";
echo "<tr><th>TEACHER NAME</th><th>TEACHER CODE</th></tr>";
foreach($rows as $row)
{
	echo "<tr>
	<td>".$row['teacher_name']."</td>
	<td>".$row['teach_code']."</td></tr>";
}
echo "</table>";
?>

</div>
</div>
</body>
</html>
