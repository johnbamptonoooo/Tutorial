<?php 

session_start();
require_once('connections/db_connection.php');

//if admin is not logged in redirect to home page
if (!isset($_SESSION['admin']))
{
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/index.php");
	exit;
}

mysql_select_db($database, $connect);

include('displays.php');
getHeader('Products', true);

?>
		<script src="js/Chart.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
	<header class="container limited page-title">
		<h1>Home</h1> 
	</header>


	<section class="container limited">

		<div class="clear">
		<!--
		<input type="text" placeholder="from..." id="datepicker_from">
		<input type="text" placeholder="to..." id="datepicker_to"> -->

		<select id="period" name="12" style="float:right; margin-left: 5px;" onchange="counts(0, this.value);"> 

			<option value="1">Last Hour</option>

			<option value="2">Today</option>

			<option value="3">This Week</option> 

			<option value="4">This Month</option>

			<option value="5" selected="selected">This Year</option>  
			 
		</select> &nbsp;&nbsp;

		<select name="123" id="type" style="float:right;" onchange="counts(this.value, 0);"> 

			<option value="1">Users</option>

			<option value="2">Chips/Gold</option>

			<option value="3">Gifts</option> 
			 
		</select> <br><br>

		</div>

		<!--<canvas id="canvas" height="450" width="900px;"></canvas>-->

	<script>

$(document).ready(function() {
	
	var getCounts = $.ajax({

		url: 'countUsers.php',

		dataType: 'json',	

		type: 'get'

}).done(function(data){

		draw_graph(data, 'Users');

}).fail(function(data){

		alert("Error");

}); 

 	
}); 


function counts(data,data1){

	if (data==0) {

		var data=$("#type").val();

	}

	if (data1==0) {

		var data1=$("#period").val();

	}
	
 
	if (data == 1) {

	var getCounts = $.ajax({

			url: 'countUsers.php',

			dataType: 'json',	

			type: 'POST',

			data: { period: ""+String(data1)+"" }

	}).done(function(data){

			draw_graph(data, 'Users', data1);

	}).fail(function(data){

			alert("Error");

	}); 

}
	if (data == 2) {

	var getCounts = $.ajax({

			url: 'countChipsGold.php',

			dataType: 'json',	

			type: 'POST',

			data: { period: ""+String(data1)+"" }

	}).done(function(data){

			draw_graph(data, 'Chips/Gold', data1);

	}).fail(function(data){

			alert("Error");

	}); 

}
	if (data == 3) {

	var getCounts = $.ajax({

			url: 'countGifts.php',

			dataType: 'json',	

			type: 'POST',

			data: { period: ""+String(data1)+"" }

	}).done(function(data){

			draw_graph(data, 'Gifts', data1);

	}).fail(function(data){

			alert("Error");

	}); 

}
}

function draw_graph(data,data1,period){	

	//alert(period);

//*****************************************************************************************************PERIOD LAST HOUR
if (period == 1) {	

for (var i = 0; i < data.length; i++) {
	
	if (data[i]==null) {

	data[i] = 0;
	data[i] = parseInt(data[i]);

	}
}

var value1 = 0;
var value2 = 0;

if (data1 == 'Users') {

	value1 = 'Registered users';
	value2 = 'Active users';
	value3 = 'Facebook users';

 
};
if (data1 == 'Chips/Gold') {

	value1 = 'Chips';
	value2 = 'Gold';
	value3 = 'Money earned';

 
};
if (data1 == 'Gifts') {

	value1 = 'Payed in gold';
	value2 = 'Payed in chips';
	value3 = 'Gifts quantity';


};
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'areaspline'
            },
            title: {
                text: data1 
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
            	 gridLineWidth: 0,  
                categories: [0,'','','','','','','','','',10,'','','','','','','','','',20,'','','','','','','','','',30,'','','','','','','','','',40,'','','','','','','','','',50,'','','','','','','','','']/*, 
                plotBands: [{ // visualize the weekend
                    from: 4.5,
                    to: 6.5,
                    color: 'rgba(68, 170, 213, .2)'
                }]*/
            },
            yAxis: {
            	 gridLineWidth: 0,
                title: {
                    text: 'Quantity' 
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ''
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
            	color: 'rgba(255, 196, 55, 1)',
                name: value1,
                data: [

					parseInt(data[0]), 
					parseInt(data[1]), 
					parseInt(data[2]), 
					parseInt(data[3]), 
					parseInt(data[4]), 
					parseInt(data[5]), 
					parseInt(data[6]), 
					parseInt(data[7]), 
					parseInt(data[8]), 
					parseInt(data[9]), 
					parseInt(data[10]), 
					parseInt(data[11]),
					parseInt(data[12]), 
					parseInt(data[13]), 
					parseInt(data[14]), 
					parseInt(data[15]), 
					parseInt(data[16]), 
					parseInt(data[17]), 
					parseInt(data[18]), 
					parseInt(data[19]), 
					parseInt(data[20]), 
					parseInt(data[21]), 
					parseInt(data[22]), 
					parseInt(data[23]),
					parseInt(data[24]), 
					parseInt(data[25]), 
					parseInt(data[26]), 
					parseInt(data[27]), 
					parseInt(data[28]), 
					parseInt(data[29]), 
					parseInt(data[30]), 
					parseInt(data[31]), 
					parseInt(data[32]), 
					parseInt(data[33]), 
					parseInt(data[34]), 
					parseInt(data[35]),
					parseInt(data[36]),
					parseInt(data[37]),
					parseInt(data[38]),
					parseInt(data[39]),
					parseInt(data[40]), 
					parseInt(data[41]), 
					parseInt(data[42]), 
					parseInt(data[43]), 
					parseInt(data[44]), 
					parseInt(data[45]),
					parseInt(data[46]),
					parseInt(data[47]),
					parseInt(data[48]),
					parseInt(data[49]),
					parseInt(data[50]), 
					parseInt(data[51]), 
					parseInt(data[52]), 
					parseInt(data[53]), 
					parseInt(data[54]), 
					parseInt(data[55]),
					parseInt(data[56]),
					parseInt(data[57]),
					parseInt(data[58]),
					parseInt(data[59])
					]
            }, {
            	color: 'rgba(165, 24, 204, 1)',
                name: value2,
                data: [

					parseInt(data[60]), 
					parseInt(data[61]), 
					parseInt(data[62]), 
					parseInt(data[63]), 
					parseInt(data[64]), 
					parseInt(data[65]),
					parseInt(data[66]),
					parseInt(data[67]),
					parseInt(data[68]),
					parseInt(data[69]),
					parseInt(data[70]), 
					parseInt(data[71]), 
					parseInt(data[72]), 
					parseInt(data[73]), 
					parseInt(data[74]), 
					parseInt(data[75]),
					parseInt(data[76]),
					parseInt(data[77]),
					parseInt(data[78]),
					parseInt(data[79]),
					parseInt(data[80]), 
					parseInt(data[81]), 
					parseInt(data[82]), 
					parseInt(data[83]), 
					parseInt(data[84]), 
					parseInt(data[85]),
					parseInt(data[86]),
					parseInt(data[87]),
					parseInt(data[88]),
					parseInt(data[89]),
					parseInt(data[90]), 
					parseInt(data[91]), 
					parseInt(data[92]), 
					parseInt(data[93]), 
					parseInt(data[94]), 
					parseInt(data[95]),
					parseInt(data[96]),
					parseInt(data[97]),
					parseInt(data[98]),
					parseInt(data[99]),
					parseInt(data[100]), 
					parseInt(data[101]), 
					parseInt(data[102]), 
					parseInt(data[103]), 
					parseInt(data[104]), 
					parseInt(data[105]),
					parseInt(data[106]),
					parseInt(data[107]),
					parseInt(data[108]),
					parseInt(data[109]),
					parseInt(data[110]), 
					parseInt(data[111]), 
					parseInt(data[112]), 
					parseInt(data[113]), 
					parseInt(data[114]), 
					parseInt(data[115]),
					parseInt(data[116]),
					parseInt(data[117]),
					parseInt(data[118]),
					parseInt(data[119])
					]
            }, {
            	color: 'rgba(79, 16, 97, 1)', 
                name: value3,
                data: [
					parseInt(data[120]), 
					parseInt(data[121]), 
					parseInt(data[122]), 
					parseInt(data[123]), 
					parseInt(data[124]), 
					parseInt(data[125]),
					parseInt(data[126]),
					parseInt(data[127]),
					parseInt(data[128]),
					parseInt(data[129]),					
					parseInt(data[130]), 
					parseInt(data[131]), 
					parseInt(data[132]), 
					parseInt(data[133]), 
					parseInt(data[134]), 
					parseInt(data[135]),
					parseInt(data[136]),
					parseInt(data[137]),
					parseInt(data[138]),
					parseInt(data[139]),
					parseInt(data[140]), 
					parseInt(data[141]), 
					parseInt(data[142]), 
					parseInt(data[143]), 
					parseInt(data[144]), 
					parseInt(data[145]),
					parseInt(data[146]),
					parseInt(data[147]),
					parseInt(data[148]),
					parseInt(data[149]),
					parseInt(data[150]), 
					parseInt(data[151]), 
					parseInt(data[152]), 
					parseInt(data[153]), 
					parseInt(data[154]), 
					parseInt(data[155]),
					parseInt(data[156]),
					parseInt(data[157]),
					parseInt(data[158]),
					parseInt(data[159]),
					parseInt(data[160]), 
					parseInt(data[161]), 
					parseInt(data[162]), 
					parseInt(data[163]), 
					parseInt(data[164]), 
					parseInt(data[165]),
					parseInt(data[166]),
					parseInt(data[167]),
					parseInt(data[168]),
					parseInt(data[169]),
					parseInt(data[170]), 
					parseInt(data[171]), 
					parseInt(data[172]), 
					parseInt(data[173]), 
					parseInt(data[174]), 
					parseInt(data[175]),
					parseInt(data[176]),
					parseInt(data[177]),
					parseInt(data[178]), 
					parseInt(data[179])

					]
            }]
        });
    });

}
//*****************************************************************************************************PERIOD TODAY
else if (period == 2) {	

for (var i = 0; i < data.length; i++) {
	
	if (data[i]==null) {

	data[i] = 0;
	data[i] = parseInt(data[i]);

	}
}

var value1 = 0;
var value2 = 0;

if (data1 == 'Users') {

	value1 = 'Registered users';
	value2 = 'Active users';
	value3 = 'Facebook users';

 
};
if (data1 == 'Chips/Gold') {

	value1 = 'Chips';
	value2 = 'Gold';
	value3 = 'Money earned';

 
};
if (data1 == 'Gifts') {

	value1 = 'Payed in gold';
	value2 = 'Payed in chips';
	value3 = 'Gifts quantity';


};
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'areaspline'
            },
            title: {
                text: data1 
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
            	 gridLineWidth: 0,  
                categories: [1,'','','','','','','','','','',12,'','','','','','','','','','','',24]/*, 
                plotBands: [{ // visualize the weekend
                    from: 4.5,
                    to: 6.5,
                    color: 'rgba(68, 170, 213, .2)'
                }]*/
            },
            yAxis: {
            	 gridLineWidth: 0,
                title: {
                    text: 'Quantity' 
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ''
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
            	color: 'rgba(255, 196, 55, 1)',
                name: value1,
                data: [

					parseInt(data[0]), 
					parseInt(data[1]), 
					parseInt(data[2]), 
					parseInt(data[3]), 
					parseInt(data[4]), 
					parseInt(data[5]), 
					parseInt(data[6]), 
					parseInt(data[7]), 
					parseInt(data[8]), 
					parseInt(data[9]), 
					parseInt(data[10]), 
					parseInt(data[11]),
					parseInt(data[12]),  
					parseInt(data[13]), 
					parseInt(data[14]), 
					parseInt(data[15]), 
					parseInt(data[16]), 
					parseInt(data[17]), 
					parseInt(data[18]), 
					parseInt(data[19]), 
					parseInt(data[20]), 
					parseInt(data[21]), 
					parseInt(data[22]), 
					parseInt(data[23])
					]
            }, {
            	color: 'rgba(165, 24, 204, 1)',
                name: value2,
                data: [

					parseInt(data[24]), 
					parseInt(data[25]), 
					parseInt(data[26]), 
					parseInt(data[27]), 
					parseInt(data[28]), 
					parseInt(data[29]), 
					parseInt(data[30]), 
					parseInt(data[31]), 
					parseInt(data[32]), 
					parseInt(data[33]), 
					parseInt(data[34]), 
					parseInt(data[35]),
					parseInt(data[36]),
					parseInt(data[37]),
					parseInt(data[38]),
					parseInt(data[39]),
					parseInt(data[40]), 
					parseInt(data[41]), 
					parseInt(data[42]), 
					parseInt(data[43]), 
					parseInt(data[44]), 
					parseInt(data[45]),
					parseInt(data[46]),
					parseInt(data[47])
					]
            }, {
            	color: 'rgba(79, 16, 97, 1)', 
                name: value3,
                data: [	

                	parseInt(data[48]),
					parseInt(data[49]),
					parseInt(data[50]), 
					parseInt(data[51]), 
					parseInt(data[52]), 
					parseInt(data[53]), 
					parseInt(data[54]), 
					parseInt(data[55]),
					parseInt(data[56]),
					parseInt(data[57]),
					parseInt(data[58]),
					parseInt(data[59]),
					parseInt(data[60]), 
					parseInt(data[61]), 
					parseInt(data[62]), 
					parseInt(data[63]), 
					parseInt(data[64]), 
					parseInt(data[65]),
					parseInt(data[66]),
					parseInt(data[67]),
					parseInt(data[68]),
					parseInt(data[69]),
					parseInt(data[70]), 
					parseInt(data[71]), 
					parseInt(data[72])

					]
            }]
        });
    });

}
//*****************************************************************************************************PERIOD THIS monzh
else if (period == 4) {	

for (var i = 0; i < data.length; i++) {
	
	if (data[i]==null) {

	data[i] = 0;
	data[i] = parseInt(data[i]);

	}
}

var value1 = 0;
var value2 = 0;

if (data1 == 'Users') {

	value1 = 'Registered users';
	value2 = 'Active users';
	value3 = 'Facebook users';

 
};
if (data1 == 'Chips/Gold') {

	value1 = 'Chips';
	value2 = 'Gold';
	value3 = 'Money earned';

 
};
if (data1 == 'Gifts') { 

	value1 = 'Payed in gold';
	value2 = 'Payed in chips';
	value3 = 'Gifts quantity';


};
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'areaspline'
            },
            title: {
                text: data1 
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
            	 gridLineWidth: 0,  
                categories: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]/*, 
                plotBands: [{ // visualize the weekend
                    from: 4.5,
                    to: 6.5,
                    color: 'rgba(68, 170, 213, .2)'
                }]*/
            },
            yAxis: { 
            	 gridLineWidth: 0,
                title: {
                    text: 'Quantity' 
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ''
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
            	color: 'rgba(255, 196, 55, 1)',
                name: value1,
                data: [

					parseInt(data[0]), 
					parseInt(data[1]), 
					parseInt(data[2]), 
					parseInt(data[3]), 
					parseInt(data[4]), 
					parseInt(data[5]), 
					parseInt(data[6]), 
					parseInt(data[7]), 
					parseInt(data[8]), 
					parseInt(data[9]), 
					parseInt(data[10]), 
					parseInt(data[11]),
					parseInt(data[12]),  
					parseInt(data[13]), 
					parseInt(data[14]), 
					parseInt(data[15]), 
					parseInt(data[16]), 
					parseInt(data[17]), 
					parseInt(data[18]), 
					parseInt(data[19]), 
					parseInt(data[20]), 
					parseInt(data[21]), 
					parseInt(data[22]), 
					parseInt(data[23]),
					parseInt(data[24]), 
					parseInt(data[25]), 
					parseInt(data[26]), 
					parseInt(data[27]), 
					parseInt(data[28]), 
					parseInt(data[29]), 
					parseInt(data[30])

					]
            }, {
            	color: 'rgba(165, 24, 204, 1)',
                name: value2,
                data: [
					parseInt(data[31]), 
					parseInt(data[32]), 
					parseInt(data[33]), 
					parseInt(data[34]), 
					parseInt(data[35]),
					parseInt(data[36]),
					parseInt(data[37]),
					parseInt(data[38]),
					parseInt(data[39]),
					parseInt(data[40]), 
					parseInt(data[41]), 
					parseInt(data[42]), 
					parseInt(data[43]), 
					parseInt(data[44]), 
					parseInt(data[45]),
					parseInt(data[46]),
					parseInt(data[47]),
             	  	parseInt(data[48]),
					parseInt(data[49]),
					parseInt(data[50]), 
					parseInt(data[51]), 
					parseInt(data[52]), 
					parseInt(data[53]), 
					parseInt(data[54]), 
					parseInt(data[55]),
					parseInt(data[56]),
					parseInt(data[57]),
					parseInt(data[58]),
					parseInt(data[59]),
					parseInt(data[60]), 
					parseInt(data[61]), 
					
					]
            }, {
            	color: 'rgba(79, 16, 97, 1)', 
                name: value3,
                data: [	

					parseInt(data[62]), 
					parseInt(data[63]), 
					parseInt(data[64]), 
					parseInt(data[65]),
					parseInt(data[66]),
					parseInt(data[67]),
					parseInt(data[68]),
					parseInt(data[69]),
					parseInt(data[70]), 
					parseInt(data[71]), 
					parseInt(data[72]), 
					parseInt(data[73]), 
					parseInt(data[74]), 
					parseInt(data[75]),
					parseInt(data[76]),
					parseInt(data[77]),
					parseInt(data[78]),
					parseInt(data[79]),
					parseInt(data[80]), 
					parseInt(data[81]), 
					parseInt(data[82]), 
					parseInt(data[83]), 
					parseInt(data[84]), 
					parseInt(data[85]),
					parseInt(data[86]),
					parseInt(data[87]),
					parseInt(data[88]),
					parseInt(data[89]),
					parseInt(data[90]), 
					parseInt(data[91]), 
					parseInt(data[92])

					]
            }] 
        });
    });

}
//*****************************************************************************************************PERIOD THIS week
else if (period == 3) {	

for (var i = 0; i < data.length; i++) {
	
	if (data[i]==null) {

	data[i] = 0;
	data[i] = parseInt(data[i]);

	}
}

var value1 = 0;
var value2 = 0;

if (data1 == 'Users') {

	value1 = 'Registered users';
	value2 = 'Active users';
	value3 = 'Facebook users';

 
};
if (data1 == 'Chips/Gold') {

	value1 = 'Chips';
	value2 = 'Gold';
	value3 = 'Money earned';

 
};
if (data1 == 'Gifts') {

	value1 = 'Payed in gold';
	value2 = 'Payed in chips';
	value3 = 'Gifts quantity';


};
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'areaspline'
            },
            title: {
                text: data1 
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
            	 gridLineWidth: 0,  
                categories: [1,2,3,4,5,6,7]/*, 
                plotBands: [{ // visualize the weekend
                    from: 4.5,
                    to: 6.5,
                    color: 'rgba(68, 170, 213, .2)'
                }]*/
            },
            yAxis: {
            	 gridLineWidth: 0,
                title: {
                    text: 'Quantity' 
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ''
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
            	color: 'rgba(255, 196, 55, 1)',
                name: value1,
                data: [

					parseInt(data[0]), 
					parseInt(data[1]), 
					parseInt(data[2]), 
					parseInt(data[3]), 
					parseInt(data[4]), 
					parseInt(data[5]), 
					parseInt(data[6]), 

					]
            }, {
            	color: 'rgba(165, 24, 204, 1)',
                name: value2,
                data: [
					parseInt(data[7]), 
					parseInt(data[8]), 
					parseInt(data[9]), 
					parseInt(data[10]), 
					parseInt(data[11]),
					parseInt(data[12]),  
					parseInt(data[13]) 
					
					]
            }, {
            	color: 'rgba(79, 16, 97, 1)', 
                name: value3,
                data: [	

					parseInt(data[14]), 
					parseInt(data[15]), 
					parseInt(data[16]), 
					parseInt(data[17]), 
					parseInt(data[18]), 
					parseInt(data[19]),  
					parseInt(data[20])

					]
            }] 
        });
    });

}
//*****************************************************************************************************PERIOD THIS YEAR
else if (period == 5) {	

for (var i = 0; i < data.length; i++) {
	
	if (data[i]==null) {

	data[i] = 0;
	data[i] = parseInt(data[i]);

	}
}

var value1 = 0;
var value2 = 0;

if (data1 == 'Users') {
 
	value1 = 'Registered users';
	value2 = 'Active users';
	value3 = 'Facebook users';

 
};
if (data1 == 'Chips/Gold') {

	value1 = 'Chips';
	value2 = 'Gold';
	value3 = 'Money earned';

 
};
if (data1 == 'Gifts') {

	value1 = 'Payed in gold';
	value2 = 'Payed in chips';
	value3 = 'Gifts quantity';


};
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'areaspline'
            },
            title: {
                text: data1 
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
            	 gridLineWidth: 0,
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']/*, 
                plotBands: [{ // visualize the weekend
                    from: 4.5,
                    to: 6.5,
                    color: 'rgba(68, 170, 213, .2)'
                }]*/
            },
            yAxis: {
            	 gridLineWidth: 0,
                title: {
                    text: 'Quantity'
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ''
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
            	color: 'rgba(255, 196, 55, 1)',
                name: value1,
                data: [

					parseInt(data[0]), 
					parseInt(data[1]), 
					parseInt(data[2]), 
					parseInt(data[3]), 
					parseInt(data[4]), 
					parseInt(data[5]), 
					parseInt(data[6]), 
					parseInt(data[7]), 
					parseInt(data[8]), 
					parseInt(data[9]), 
					parseInt(data[10]), 
					parseInt(data[11])]
            }, {
            	color: 'rgba(165, 24, 204, 1)',
                name: value2,
                data: [

					parseInt(data[12]), 
					parseInt(data[13]), 
					parseInt(data[14]), 
					parseInt(data[15]), 
					parseInt(data[16]), 
					parseInt(data[17]), 
					parseInt(data[18]), 
					parseInt(data[19]), 
					parseInt(data[20]), 
					parseInt(data[21]), 
					parseInt(data[22]), 
					parseInt(data[23])]
            }, {
            	color: 'rgba(79, 16, 97, 1)', 
                name: value3,
                data: [

					parseInt(data[24]), 
					parseInt(data[25]), 
					parseInt(data[26]), 
					parseInt(data[27]), 
					parseInt(data[28]), 
					parseInt(data[29]), 
					parseInt(data[30]), 
					parseInt(data[31]), 
					parseInt(data[32]), 
					parseInt(data[33]), 
					parseInt(data[34]), 
					parseInt(data[35])]
            }]
        });
    });

}
 
else

{
	for (var i = 0; i < data.length; i++) {
	
	if (data[i]==null) {

	data[i] = 0;
	data[i] = parseInt(data[i]);

	}
}

var value1 = 0;
var value2 = 0;

if (data1 == 'Users') {

	value1 = 'Registered users';
	value2 = 'Active users';
	value3 = 'Facebook users';

 
};
if (data1 == 'Chips/Gold') {

	value1 = 'Chips';
	value2 = 'Gold';
	value3 = 'Money earned';

 
};
if (data1 == 'Gifts') {

	value1 = 'Payed in gold';
	value2 = 'Payed in chips';
	value3 = 'Gifts quantity';


};
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'areaspline'
            },
            title: {
                text: data1 
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 150,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            xAxis: {
            	 gridLineWidth: 0,
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']/*, 
                plotBands: [{ // visualize the weekend
                    from: 4.5,
                    to: 6.5,
                    color: 'rgba(68, 170, 213, .2)'
                }]*/
            },
            yAxis: {
            	 gridLineWidth: 0,
                title: {
                    text: 'Quantity'
                }
            },
            tooltip: {
                shared: true,
                valueSuffix: ''
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.5
                }
            },
            series: [{
            	color: 'rgba(255, 196, 55, 1)',
                name: value1,
                data: [

					parseInt(data[0]), 
					parseInt(data[1]), 
					parseInt(data[2]), 
					parseInt(data[3]), 
					parseInt(data[4]), 
					parseInt(data[5]), 
					parseInt(data[6]), 
					parseInt(data[7]), 
					parseInt(data[8]), 
					parseInt(data[9]), 
					parseInt(data[10]), 
					parseInt(data[11])]
            }, {
            	color: 'rgba(165, 24, 204, 1)',
                name: value2,
                data: [

					parseInt(data[12]), 
					parseInt(data[13]), 
					parseInt(data[14]), 
					parseInt(data[15]), 
					parseInt(data[16]), 
					parseInt(data[17]), 
					parseInt(data[18]), 
					parseInt(data[19]), 
					parseInt(data[20]), 
					parseInt(data[21]), 
					parseInt(data[22]), 
					parseInt(data[23])]
            }, {
            	color: 'rgba(79, 16, 97, 1)', 
                name: value3,
                data: [

					parseInt(data[24]), 
					parseInt(data[25]), 
					parseInt(data[26]), 
					parseInt(data[27]), 
					parseInt(data[28]), 
					parseInt(data[29]), 
					parseInt(data[30]), 
					parseInt(data[31]), 
					parseInt(data[32]), 
					parseInt(data[33]), 
					parseInt(data[34]), 
					parseInt(data[35])]
            }]
        });
    });

}

}



	</script>
<div id="container" style="min-width: 310px; height: 600px; margin: 0 auto"></div>
</section>
<?php getFooter(); ?> 