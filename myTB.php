<?php
$dirBin=dirname(__FILE__);
include($dirBin."/allen_config.php");
$th="";
$columnsRecord='"columns": [
';
for($i=0;$i<count($columnArr);$i++){ 
	$tmpArr=explode(":",trim($columnArr[$i]));
	$columnLabel=$tmpArr[0]; $columnName=$tmpArr[1];					 
    $columnsRecord.='{ data: "'.$columnName.'" },';
	$th.='<th align="left">'.$columnLabel.'</th>';
}
$columnsRecord=substr(trim($columnsRecord),0,-1)."],";
?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
	<title>Editor myTable - Basic initialisation</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="datatables/css/editor.dataTables.min.css">
	<style type="text/css" class="init">
	
	</style>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
	<script type="text/javascript" language="javascript" src="datatables/js/dataTables.editor.min.js"></script>
	<script type="text/javascript" language="javascript" class="init">
	


var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
	editor = new $.fn.dataTable.Editor( {
		ajax: "allen_staff.php",
		table: "#myTable"
	} );

	$('#myTable').DataTable( {
		dom: "Bfrtip",
		ajax: "allen_staff.php",
		<?=$columnsRecord;?>
		select: true,
        /*lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],*/		
		buttons: [
            /*'pageLength',*/		
			{ extend: "remove", editor: editor }
		],
        scrollY:        '65vh',
        scrollCollapse: true,
        paging:         false		
	} );
} );



	</script>
</head>
<body>
	<div style="width:100%">
		<section>
			<table id="myTable" class="display" style="width:100%">
				<thead>
					<tr>
					<?=$th;?>
					</tr>
				</thead>
			</table>
	  </section>
	</div>
</body>
</html>
