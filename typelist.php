<?php
	header('Content-Type: text/html; charset=utf-8');
	define('DB_NAME', '192.168.1.52:D:\FBBaseFinance\FBBaseFinance.fdb');
	define('DB_USER', 'sysdba');
	define('DB_PASS', 'dev#1901');

	$link=ibase_connect(DB_NAME,DB_USER,DB_PASS);
	
	if (isset($_POST) and isset($_POST["typetext"]) and $_POST["typetext"]!="")
	{
		$typetext=$_POST["typetext"];
		$query="insert into TBLOUTTYPES (TYPETEXT) values ('".$typetext."')";
		$result=ibase_query($link,$query);		
	}

	$query="select TYPETEXT from TBLOUTTYPES order by TYPETEXT";
	$result=ibase_query($link,$query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Виды расходов</title>
	<link  href="/finance/css/css-framework.css" rel="stylesheet">
	<link  href="/finance/css/style.css" rel="stylesheet">
</head>
<body>
	<div class="g">
		<div class="g-row" style="height:70"><div class="g-2"><a href="/finance/index.php">HOME</a></div></div>
		<div class="g-row">
			<div class="g-5">
				<h1>Виды расходов</h1>
				<table>	
					<thead>
						<tr>
							<th>Text</th>							
						</tr>
					</thead>
					<tbody>
						<?php
							while ($row=ibase_fetch_object($result))
							{
								echo("<tr>");
								echo("<td>".$row->TYPETEXT."</td>");
								echo("</tr>");
							}
						?>
					</tbody>
				</table>	
			</div>
			<div class="g-6">
				<h1>ВВОД ВИДА РАСХОДОВ</h1>
				<form method="post" action="">
					<p>Новый вид расходов<input type="text" name="typetext" value=""></p>
					<button class="f-bu f-bu-default" type="submit">ДОБАВИТЬ</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>