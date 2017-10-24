<?php
	header('Content-Type: text/html; charset=utf-8');
	define('DB_NAME', '192.168.1.52:D:\FBBaseFinance\FBBaseFinance.fdb');
	define('DB_USER', 'sysdba');
	define('DB_PASS', 'dev#1901');

	$link=ibase_connect(DB_NAME,DB_USER,DB_PASS);
	
	if (isset($_POST))
	{
		$acname=$_POST["acname"];
		$accode=$_POST["accode"];
		$query="insert into TBLACCOUNTS (ACCODE,ACNAME) values ($accode,'".$acname."')";
		$result=ibase_query($link,$query);		
	}

	$query="select ACCODE,ACNAME from TBLACCOUNTS order by ACCODE";
	$result=ibase_query($link,$query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>СЧЕТА</title>
	<link  href="/finance/css/css-framework.css" rel="stylesheet">
	<link  href="/finance/css/style.css" rel="stylesheet">
</head>
<body>
	<div class="g">
		<div class="g-row" style="height:70"><div class="g-2"><a href="/finance/index.php">HOME</a></div></div>
		<div class="g-row">
			<div class="g-5">
				<h1>СЧЕТА</h1>
				<table>	
					<thead>
						<tr>
							<th>Code</th>							
							<th>Text</th>	
						</tr>
					</thead>
					<tbody>
						<?php
							while ($row=ibase_fetch_object($result))
							{
								echo("<tr>");
								echo("<td>".$row->ACCODE."</td>");
								echo("<td>".$row->ACNAME."</td>");
								echo("</tr>");
							}
						?>
					</tbody>
				</table>	
			</div>
			<div class="g-6">
				<h1>ВВОД НОВОГО СЧЁТА</h1>
				<form method="post" action="">
					<p>Номер счёта<input type="text" name="accode"></p><br>
					<p>Название счёт<input type="text" name="acname"></p><br>
					<button class="f-bu f-bu-default" type="submit">ДОБАВИТЬ</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>