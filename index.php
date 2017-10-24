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

	$query="select ACCODE,ACNAME,ACSUM from TBLACCOUNTS order by ACCODE";
	$result=ibase_query($link,$query);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Система учёта финансов</title>
	<link  href="/finance/css/css-framework.css" rel="stylesheet">
	<link  href="/finance/css/style.css" rel="stylesheet">
</head>
<body>
	
	<div class="g">
	<header>
		<h1 style="text-align: center">СИСТЕМА УЧЁТА ФИНАНСОВ</h1>
	</header>	
		<div class="g-row" >
			<div class="g-2" style="text-align: center"></div>
			<div class="g-8 my_border" style="text-align: center">СПИСОК СЧЕТОВ
				<table>
					<tbody>
						<?php
							while ($row=ibase_fetch_object($result))
							{
								echo("<tr>");
								echo("<td>".$row->ACCODE."</td>");
								echo("<td>".$row->ACNAME."</td>");
								echo("<td>".$row->ACSUM."</td>");
								echo("</tr>");
							}
						?>
					</tbody>
				</table>
			</div> <!--Реестр счетов-->
			<div class="g-2" style="text-align: center">
				<form action="/finance/outcomesinsert.php">
					<button class="f-bu f-bu-default my_button">Внести расходы</button>
				</form>
				<form action="/finance/incomesinsert.php">
					<button class="f-bu f-bu-success my_button">Внести доходы</button>
				</form>
				<form action="/finance/typelist.php">
					<button class="f-bu f-bu-warning my_button">Виды расходов</button>
				</form>
				<form action="/finance/accountlist.php">
					<button class="f-bu f-bu-warning my_button">Счета</button>
				</form>
			</div>
		</div>
	</div> <!--основной блок-->
</body>
</html>