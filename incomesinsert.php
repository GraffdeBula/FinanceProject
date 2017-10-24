<?php
	header('Content-Type: text/html; charset=utf-8');
	define('DB_NAME', '192.168.1.52:D:\FBBaseFinance\FBBaseFinance.fdb');
	define('DB_USER', 'sysdba');
	define('DB_PASS', 'dev#1901');

	$link=ibase_connect(DB_NAME,DB_USER,DB_PASS);
	
	if ((isset($_POST)) and (isset($_POST["formtype"])) and ($_POST["formtype"]=="inc_insert"))
	{
		$intext=$_POST["in_text"];
		$insum=$_POST["in_sum"];
		$indate=$_POST["in_date"];
		$query="insert into TBLINCOMES (INTEXT, INSUM, INDATE) values ('".$intext."',$insum,'".$indate."')";
		$result=ibase_query($link,$query);	
		$sql="execute procedure PRC_CURACC";
		$query2=ibase_prepare($sql);
		$result2=ibase_execute(query)
	}


	if ((isset($_POST)) and (isset($_POST["formtype"])) and ($_POST["formtype"]=="inc_upd"))
	{
		$incode=$_POST["in_code"];
		$intext=$_POST["in_text"];
		$insum=$_POST["in_sum"];
		$indate=$_POST["in_date"];
		$query="update TBLINCOMES set INSUM=".$insum." , INDATE='".$indate."' , INTEXT='".$intext."' where INCODE=".$incode;
		$result=ibase_query($link,$query);
	}

	if ((isset($_POST)) and (isset($_POST["formtype"])) and ($_POST["formtype"]=="inc_del"))
	{
		$incode=$_POST["in_code"];
		$query="delete from TBLINCOMES where INCODE=".$incode;
		$result=ibase_query($link,$query);	
	}

	$query="select INCODE, INTEXT, INSUM, INDATE from TBLINCOMES order by INCODE desc";
	$result=ibase_query($link,$query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>IncomesInsert</title>
	<link  href="/finance/css/css-framework.css" rel="stylesheet">
	<link  href="/finance/css/style.css" rel="stylesheet">
</head>
<body>
	<div class="g">
		<div class="g-row" style="height:70">
			<div class="g-2"><a href="/finance/index.php">HOME</a></div>
		</div>
		<div class="g-row">
			<div class="g-7 my_border">
				<h1>Список доходов</h1>
				<table>	
					<thead>
						<tr>
							<th>ID</th>
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
								echo("<td>".$row->INCODE."</td>");
								echo("<td>".$row->INTEXT."</td>");
								echo("<td>".$row->INSUM."</td>");
								echo("<td>".$row->INDATE."</td>");
								echo("</tr>");
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="g-4 my_border">
				<div class="g-row">
					<h1>Внесение дохода</h1>
					<form action="" method="post">
						<input type="hidden" name="formtype" value="inc_insert">
						<p>Дата прихода<input type="date" name="in_date"></p><br>
						<p>Сумма прихода<input type="text" name="in_sum"></p><br>
						<p>Описание<input type="text" name="in_text"></p><br>
						<button type="submit" class="f-bu f-bu-success my_button">ВНЕСТИ</button>
					</form>
				</div>
				<div>
					<h1>Удаление/изменение дохода</h1>
					<form action="" method="post">
						<input type="hidden" name="formtype" value="" id="op_type">
						<p>Вид операции
							<select onchange="formSelect(this)">
								<option></option>
								<option>ИЗМЕНИТЬ</option>
								<option>УДАЛИТЬ</option>
							</select>
						</p>
						<p>Код прихода<input type="text" name="in_code" value="" id="edit1"></p>
						<p>Дата прихода<input type="date" name="in_date" value="" id="edit1"></p>
						<p>Сумма прихода<input type="text" name="in_sum" value="" id="edit1"></p>
						<p>Описание<input type="text" name="in_text"></p>
						<button type="submit" class="f-bu f-bu-success my_button" id="button1">УДАЛИТЬ/ИЗМЕНИТЬ</button>										
					</form>
				</div>
			</div>
		</div>

	</div> <!--основной блок-->

	<script> /*блок управления формой редактирования*/
		function formSelect(type){			
			var button1=document.getElementById('button1');
			var opType=document.getElementById('op_type');
			button1.innerHTML=type.value;
			if (type.value=="ИЗМЕНИТЬ") {
				opType.value="inc_upd";
			}
			if (type.value=="УДАЛИТЬ") {
				opType.value="inc_del";
			}
		}
	</script> 	
</body>
</html>