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
<form>


<select autofocus="autofocus" title="Choose the matriz operation" id="ops">
<option value="sum">Sum</option>
<option value="sub">Subtract</option>
<option value="mult">Multiply</option>
<option value="div">Divide</option>
</select>
<br><br>
Size:
<input type="number" value="1" min="1" maxlength="5" onchange="changeSize1();" title="Insert the size of the matrix" id="rows">
<br><br>
<h5>A = </h5>
<table id="matrix-table-result">
	<tr>
		<td><input type="text" name="a[0][0]" style="width:40px;" id="a[0][0]" required="required"></td>
	</tr>
</table><br>
<button type="button" onclick="changeSize1();">Criar!</button>
<button type="button" onclick="ajax();">Calcular Determinante!</button>
</form>
<p>
	<div id="result">
	
	</div>
</p>
<script type="text/javascript">

function changeSize1()
{
	var xmlhttp = new XMLHttpRequest();

   	xmlhttp.open("POST", "control.php", false);
   	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("q=size&rows="+document.getElementById("rows").value+"&cols="+document.getElementById("rows").value);
	document.getElementById("matrix-table-result").innerHTML = xmlhttp.responseText;
}

function ajax()
{
	var xmlhttp = new XMLHttpRequest();

   	xmlhttp.open("POST", "control.php", false);
   	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("q=determinant&"+serialize(document.forms[0]));
	document.getElementById("result").innerHTML = xmlhttp.responseText;
}

</script>
<script type="text/javascript" src="http://form-serialize.googlecode.com/svn/trunk/serialize-0.2.min.js"></script>
</body>
</html>