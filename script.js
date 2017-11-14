var tableName="";

$(document).ready(function(){
	
	$('.aut').click(function(){
		tableName = "autorzy";
	});

	$('.era').click(function(){
		tableName = "epoki";
	});

	$('.lit').click(function(){
		tableName = "dziela";
	});

	$('.phi').click(function(){
		tableName = "filozofie_i_kierunki";
	});

	$('.mot').click(function(){
		tableName = "motywy";
	});
	
	$('button').click(function(){
		showTable();
	});
	
});

function showTable()
{
	$.ajax
	({
		method: "GET",
		url: "connection2.php",
		data:  {"tableName": tableName},
		dataType: "json",
		converters: {"text json": jQuery.parseJSON}
	})
	.done(function(array) 
	{
		var myTable= "<table class='table table-bordered table-dark table-hover table-responsive table-striped'><thead><tr class='bg-primary'>";
		
		for (var i= 0; i < array.names_of_columns.length; i++)
		{
			myTable+="<th scope='col'>"+array.names_of_columns[i]+"</th>";
		}
		myTable+="</tr></thead><tbody>";
		
		for(var i=0; i<array.num_of_rows; i++)
		{
			myTable+="<tr>";
			
			for(var j=0; j<array.names_of_columns.length; j++)
			{
				myTable+="<td>" + array.results[i][j] + "</td>";
			} 
			myTable+="</tr>";
		}

		myTable+="</table>";
		
		document.getElementById('ajax').innerHTML = myTable;
		
    }).fail(function() {
    console.log("error ajax");
	});
}
