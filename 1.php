<?php
	if(!$id = mysql_connect('localhost','root',''))
		{
			exit("Błąd połączenia z serwerem");
		}
		else
		{
			if(!$baza = mysql_select_db('matura',$id))
			{
				exit("Błąd połączenia z bazą danych : matura");
			}
			else
			{
				mysql_query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
				$wynik = mysql_query("select * from epoki");
				
				echo "<table border='1'>";
				
				while($tab = mysql_fetch_array($wynik))
				{
					echo"<tr>";
					echo "<td>".$tab['id_epoki']."</td>"."<td>".$tab['nazwa']."</td>";
					echo"</tr>";
				}
				
				echo "</table>";
			}
			mysql_close($id);
		}
?>
