<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Create Matrix</title>
<style type="text/css">
*{font-family: sans-serif;} 
#matrix-table-result, #matrix-table-result2, #matrix-table-result td, #matrix-table-result2 td, #matrix-table-result tr, #matrix-table-result2 tr
{ 
	border:1px solid black;
}
</style>

</head>
<body>
<h2>Create Matriz to operate</h2>
<h4>Operation:</h4>
<select autofocus="autofocus" title="Choose the matriz operation" id="ops">
<option value="sum">Sum</option>
<option value="sub">Subtract</option>
<option value="mult">Multiply</option>
<option value="div">Divide</option>
</select>
<br><br>
Rows:
<input type="number" value="1" min="1" maxlength="5" onchange="changeSize1();" title="Insert the number of rows" id="rows">
<br>
Cols:
<input type="number" value="1" min="1" maxlength="5" onchange="changeSize1();" title="Insert the number of cols" id="cols">
<br><br>
<div>
<h5>A = </h5>
<table id="matrix-table-result">
	<tr>
		<td><input type="text" name="a[0][0]" style="width:40px;" id="a[0][0]" required="required"></td>
	</tr>
</table>
<br><br>
Rows:
<input type="number" value="1" min="1" maxlength="5" onchange="changeSize2();" title="Insert the number of rows" id="rows2">
<br>
Cols:
<input type="number" value="1" min="1" maxlength="5" onchange="changeSize2();" title="Insert the number of cols" id="cols2">
<br>
<h5>B = </h5>
<table id="matrix-table-result2">
	<tr>
		<td><input type="text" name="a[0][0]" style="width:40px;" id="a[0][0]" required="required"></td>
	</tr>
</table>
<br><br>
<div id="resulted">
		
	</div>
</div>

<script type="text/javascript">

function changeSize1()
{
	var xmlhttp = new XMLHttpRequest();

   	xmlhttp.open("POST", "control.php", false);
   	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("q=size&rows="+document.getElementById("rows").value+"&cols="+document.getElementById("cols").value);
	document.getElementById("matrix-table-result").innerHTML = xmlhttp.responseText;
}

function changeSize2()
{
	var xmlhttp = new XMLHttpRequest();

   	xmlhttp.open("POST", "control.php", false);
   	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("q=size&rows="+document.getElementById("rows2").value+"&cols="+document.getElementById("cols2").value);
	document.getElementById("matrix-table-result2").innerHTML = xmlhttp.responseText;
}

</script>
<script type="text/javascript" src="http://form-serialize.googlecode.com/svn/trunk/serialize-0.2.min.js"></script>

</body>
</html>