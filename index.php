﻿<?php

####################################
### Universal Terminal GUI v.01    #
### Author: Julian Zelina          #
####################################

# Main
$title = "Universal Terminal GUI";

# disable Error and Warnings
error_reporting(E_ALL & ~E_NOTICE);

# configure environment

if (isset($_SERVER['HTTPS'])) { $ME = "https://".$_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT'].$_SERVER['SCRIPT_NAME']; }
else { $ME = "http://".$_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT'].$_SERVER['SCRIPT_NAME']; }

# include
@include("functions.php"); #main function
@include("detect.php"); # detect terminal

# language

$lang["ok"] = "OK";
$lang["cancel"] = "CANCEL";


#include

# setup
if ($_GET['setup'] != "")
	{
	@include("create.php"); #GUI to create files
	exit;
	}

# read
if ($_GET['read'] != "")
	{
	@include("read.php"); #deliver content to terminal
	exit;
	}
	
	
#test aastra
if ($_GET['test'] == "aastra")
	{
	#show test menu aastra
	exit;
	}
	
# main

$out =  '<html><head><title>'.$title.'</title><meta http-equiv="content-type" content="text/html; charset=UTF-8" /></head><body>';
$out .= 'Welcome to UTG';
$out .= '<br /><a href="?setup=1">Create Page</a>';
$out .= '<br /><br />Pages: ';

$handle = opendir("db/");
	while ($res = readdir($handle)) { if (!(is_dir($res)) && preg_match("/\.xml/",$res) )
	$out .= '<br /><a href="?read='.str_replace(".xml", "", $res).'">'.$res.'</a>';
	}
	
$out .= '</body><html>';
echo $out;

?>