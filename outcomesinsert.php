<?php
	header('Content-Type: text/html; charset=utf-8');
	define('DB_NAME', '192.168.1.52:D:\FBBaseFinance\FBBaseFinance.fdb');
	define('DB_USER', 'sysdba');
	define('DB_PASS', 'dev#1901');

	$link=ibase_connect(DB_NAME,DB_USER,DB_PASS);
	
	if (isset($_POST))
	{
		$outtext=$_POST["out_text"];
		$outtype=$_POST["out_type"];
		$outsum=$_POST["out_sum"];
		$outdate=$_POST["out_date"];
		$query="insert into TBLOUTCOMES (OUTTYPE, OUTTEXT, OUTSUM, OUTDATE) values ('".$outtype."','".$outtext."',$outsum,'".$outdate."')";
		$result=ibase_query($link,$query);		
	}

	$query="select OUTCODE, OUTTYPE, OUTTEXT, OUTSUM, OUTDATE from TBLOUTCOMES order by OUTCODE desc";
	$result=ibase_query($link,$query);
	
	$query2="select TYPETEXT from TBLOUTTYPES order by TYPETEXT";
	$result2=ibase_query($link,$query2);

?>
<!DOCTYPE html>
<html>
<head>
	<title>OutcomesInsert</title>
	<link  href="/finance/css/css-framework.css" rel="stylesheet">
	<link  href="/finance/css/style.css" rel="stylesheet">
</head>
<body>
	<div class="g">
		<div class="g-row" style="height:70"><div class="g-2"><a href="/finance/index.php">HOME</a></div></div>
		<div class="g-row">
			<div class="g-7 my_border">
				<h1>Список расходов</h1>
				<table>	
					<thead>
						<tr>
							<th>ID</th>
							<th>Type</th>
							<th>Text</th>
							<th>Sum</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php
							while ($row=ibase_fetch_object($result))
							{
								echo("<tr>");
								echo("<td>".$row->OUTCODE."</td>");
								echo("<td>".$row->OUTTYPE."</td>");
								echo("<td>".$row->OUTTEXT."</td>");
								echo("<td>".$row->OUTSUM."</td>");
								echo("<td>".$row->OUTDATE."</td>");
								echo("</tr>");
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="g-4 my_border">
				<h1>Внесение расхода</h1>
				<form action="" method="post">
					<p>Дата расхода<input type="date" name="out_date"></p><br>
					<p>Сумма расхода<input type="text" name="out_sum"></p><br>
					<p>Описание<input type="text" name="out_text"></p><br>
					<p>Вид расхода
						<select type="text" name="out_type"> 							
							<option></option>
							<?php 
								while($row=ibase_fetch_object($result2))
								{
									echo("<option>");
									echo($row->TYPETEXT);
									echo("</option>");
								}
							?>									
						</select>
					</p><br>
					
					<button type="submit" class="f-bu f-bu-default">ВНЕСТИ</button>
				</form>
			</div>
		</div>

	</div> <!--основной блок-->
</body>
</html>