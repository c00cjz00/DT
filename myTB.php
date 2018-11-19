<?php
$TB_name="nuke_cities";
//$columnLimitArr=array("title","author"); 
$limitColumn='id'; $limitValue='none';  $equalValue="!=";
$today  = mktime( date("H") , date("i"), date("s"), date("m")  , date("d"), date("Y"));
$encodeKey=base64_encode($today);



$dirBin=dirname(__FILE__);
include($dirBin."/myTB_config.php");
$con=mysqli_connect($DB_host,$DB_user,$DB_pass,$DB_name);
// Check connection
if (mysqli_connect_errno()){
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$getLinks="TB_name=".$TB_name."&limitColumn=".$limitColumn."&limitValue=".$limitValue."&equalValue=".$equalValue."&encodeKey=".$encodeKey;


 $th=""; $columnsRecord='"columns": ['; $columnArr=array();
if (!isset($columnLimitArr)) $columnLimitArr=array();
$sql = "show full columns from `".$TB_name."`";
if ($result=mysqli_query($con,$sql)){	
 while ($row=mysqli_fetch_row($result)){
  $column = $row[0]; $comment = trim($row[8]); 
  if ($comment!=""){  $label=$comment; }else{  $label=$column; }   
  if (count($columnLimitArr)>0){ 
   if (in_array($column,$columnLimitArr)) array_push($columnArr,$label.":".$column);
  }else{
   array_push($columnArr,$label.":".$column);	  
  }
 }
}

for($i=0;$i<count($columnArr);$i++){ 
 $tmpArr=explode(":",trim($columnArr[$i]));
 $columnLabel=$tmpArr[0]; $columnName=$tmpArr[1];					 
 $columnsRecord.='{ data: "'.$columnName.'" },';
 $th.='<th align="left">'.$columnLabel.'</th>';
 $getLinks.="&c[]=".$columnLabel.":".$columnName;    	
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
	<link rel="stylesheet" type="text/css" href="<?=$DT_folder;?>/css/editor.dataTables.min.css">
	<style type="text/css" class="init">
	
	</style>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
	<script type="text/javascript" language="javascript" src="<?=$DT_folder;?>/js/dataTables.editor.min.js"></script>
	<script type="text/javascript" language="javascript" class="init">
	


var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
	editor = new $.fn.dataTable.Editor( {
		ajax: "myTB_staff.php?<?=$getLinks;?>",
		table: "#myTable"
	} );

	$('#myTable').DataTable( {
		dom: "Bfrtip",
		/*ajax: "myTB_staff.php",*/
		ajax: {
			url: "myTB_staff.php?<?=$getLinks;?>",
			type: "POST"
		},		
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
		pageLength:500,
		scrollX: true,		
		scrollY:        '65vh',
                deferRender:    true,
                scroller:       true,		                
                scrollCollapse: true
                /*paging:         true*/
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
