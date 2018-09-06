<!DOCTYPE html>
<html lang="pt-BR">

	<head>

		<?php include_once 'inc/head.php'; ?>

		<title>MAXY</title>

		<?php include_once 'inc/bootstrap.php'; ?>

		<style type="text/css">

			#matrix-table-result, #matrix-table-result2, #matrix-table-result td, #matrix-table-result2 td, #matrix-table-result tr, #matrix-table-result2 tr
			{ 
				border:1px solid black;
			}
		</style>

	</head>
	<body>
		<?php include_once 'inc/navbar.php'; ?>
		<div class="container">
			<div class="starter-template">
				<form>
					<p class="lead">
					<h2>Matrices Operations</h2>
					<h4>Operation:</h4>
					<select autofocus="autofocus" name="operation" title="Choose the matriz operation" id="ops">
						<option value="sum">Sum</option>
						<option value="sub">Subtract</option>
						<option value="mult">Multiply</option>
						<option value="div">Divide</option>
					</select>
					<br><br>
					<h3>Matrix A</h3>
					<table>
						<tr>
							<td>Rows: &nbsp;</td>
							<td><input type="number" value="1" min="1" maxlength="5" onchange="changeSize1();" title="Insert the number of rows" id="rows"></td>
						</tr>
						<tr>
							<td>Cols: &nbsp;</td>
							<td><input type="number" value="1" min="1" maxlength="5" onchange="changeSize1();" title="Insert the number of cols" id="cols"></td>
						</tr>
					</table>
					<br><br>

					<div>
						<h5>A = </h5>
						<table id="matrix-table-result">
							<tr>
								<td><input type="text" name="a[0][0]" style="width:40px;" id="a[0][0]" required="required"></td>
							</tr>
						</table>
						<br><br>
						<h3>Matrix B</h3>
						<table>
							<tr>
								<td>Rows: &nbsp;</td>
								<td><input type="number" value="1" min="1" maxlength="5" onchange="changeSize2();" title="Insert the number of rows" id="rows2"></td>
							</tr>
							<tr>
								<td>Cols: &nbsp;</td>
								<td><input type="number" value="1" min="1" maxlength="5" onchange="changeSize2();" title="Insert the number of cols" id="cols2"></td>
							</tr>
						</table>
						<br>
						<h5>B = </h5>
						<table id="matrix-table-result2">
							<tr>
								<td><input type="text" name="b[0][0]" style="width:40px;" id="a[0][0]" required="required"></td>
							</tr>
						</table>
						<br><br>
						<div id="resulted">

						</div>
					</div>
					<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
						<button type="button" class="btn btn-primary" onclick="send(serialize(document.forms[0]), event);">Get Result!</button>
					</div>

					</p>
				</form><br><br>
				<div id="resultado" class="col-lg-12">

				</div>
			</div>
		</div><!-- /.container -->

		<?php include_once 'inc/scripts.php'; ?>
		<script type="text/javascript" src="http://form-serialize.googlecode.com/svn/trunk/serialize-0.2.min.js"></script>
		<script type="text/javascript">

				function changeSize1()
				{
					var xmlhttp = new XMLHttpRequest();

					xmlhttp.open("POST", "control.php", false);
					xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xmlhttp.send("q=size&let=a&rows=" + document.getElementById("rows").value + "&cols=" + document.getElementById("cols").value);
					document.getElementById("matrix-table-result").innerHTML = xmlhttp.responseText;
				}

				function changeSize2()
				{
					var xmlhttp = new XMLHttpRequest();

					xmlhttp.open("POST", "control.php", false);
					xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xmlhttp.send("q=size&let=b&rows=" + document.getElementById("rows2").value + "&cols=" + document.getElementById("cols2").value);
					document.getElementById("matrix-table-result2").innerHTML = xmlhttp.responseText;
				}

				function send(arr, event)
				{
					var xmlhttp = new XMLHttpRequest();

					xmlhttp.open("POST", "control.php", true);
					xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xmlhttp.send("q=calc&" + arr);

					xmlhttp.onreadystatechange = function () {
						if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
							document.getElementById("resultado").innerHTML = xmlhttp.responseText;
						}
					};

					//alert(xmlhttp.responseText);
				}
		</script>
	</body>
</html>