<?php
$dirBin=dirname(__FILE__);
include($dirBin."/myTB_config.php");

/*
 * Example PHP implementation used for the index.html example
 */

// DataTables PHP library
include( $DT_folder."/lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;

// cjz //	
$Field = new Field();
$whereValue="";
if (!isset($_GET['c'])) { echo "no column\n"; exit(); }
if (!isset($_GET['TB_name'])) { echo "no TB_name\n"; exit(); }
if (!isset($_GET['limitColumn'])) { echo "no limitColumn\n"; exit(); }
if (!isset($_GET['limitValue'])) { echo "no limitValue\n"; exit(); }
if (!isset($_GET['equalValue'])) { echo "no equalValue\n"; exit(); }
if (!isset($_GET['encodeKey'])) { echo "no encodeKey\n"; exit(); }
$columnArr=$_GET['c'];
$TB_name=$_GET['TB_name'];
$limitColumn=$_GET['limitColumn']; 
$limitValue=$_GET['limitValue']; 
$equalValue=$_GET['equalValue'];
$encodeKey=$_GET['encodeKey'];
$today  = mktime( date("H") , date("i"), date("s"), date("m")  , date("d"), date("Y"));
$decodeKey=base64_decode($encodeKey);
$timeDiff=($today-$decodeKey);
if ($timeDiff>1)  { echo "key error\n"; exit(); }

for($i=0;$i<count($columnArr);$i++){ 
	$tmpArr=explode(":",trim($columnArr[$i]));
	$columnLabel=$tmpArr[0]; $columnName=$tmpArr[1];	
	$inst[]=$Field::inst($columnName);	
}


// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, $TB_name )
	->fields($inst)
    ->where($limitColumn,$limitValue,$equalValue)
	#->where( 'office', 'London' )
    #->where( 'salary', 100000, '>' )
	->process( $_POST )
	->json();

