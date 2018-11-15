<?php
$dirBin=dirname(__FILE__);
include($dirBin."/myTB_config.php");


/*
 * Example PHP implementation used for the index.html example
 */

// DataTables PHP library
include( "datatables/lib/DataTables.php" );

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
for($i=0;$i<count($columnArr);$i++){ 
	$tmpArr=explode(":",trim($columnArr[$i]));
	$columnLabel=$tmpArr[0]; $columnName=$tmpArr[1];	
	$inst[]=$Field->inst($columnName);
}

	
// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, $urTB )
	->fields($inst)
    #->where( 'office', 'London' )
    #->where( 'salary', 100000, '>' )
	->process( $_POST )
	->json();

