<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/adodb.inc.php');

$DB = NewADOConnection('mysql');

$CFG['db']['host']=$host_sql;
$CFG['db']['user']=$user_sql;
$CFG['db']['pass']=$haslo_sql;
$CFG['db']['dtbs']=$baza_sql;


$db = NewADOConnection('mysql');
$db->Connect($CFG['db']['host'], $CFG['db']['user'], $CFG['db']['pass'], $CFG['db']['dtbs']);
$db->SetFetchMode(ADODB_FETCH_ASSOC);
$db->Execute("SET NAMES utf8;");
$db->debug = false;
?>