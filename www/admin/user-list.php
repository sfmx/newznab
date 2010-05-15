<?php

require_once($_SERVER['DOCUMENT_ROOT']."/lib/adminpage.php");
require_once($_SERVER['DOCUMENT_ROOT']."/lib/users.php");
define("ITEMS_PER_PAGE", "25");

$page = new AdminPage();

$users = new Users();

$page->title = "User List";

$usercount = $users->getCount();

$offset = isset($_REQUEST["offset"]) ? $_REQUEST["offset"] : 0;
$page->smarty->assign('pagertotalitems',$usercount);
$page->smarty->assign('pageroffset',$offset);
$page->smarty->assign('pageritemsperpage',ITEMS_PER_PAGE);
$page->smarty->assign('pagerquerybase', "/admin/user-list.php?offset=");
$pager = $page->smarty->fetch("pager.tpl");
$page->smarty->assign('pager', $pager);

$userlist = $users->getRange($offset, ITEMS_PER_PAGE);
$page->smarty->assign('userlist',$userlist);	

$page->content = $page->smarty->fetch('admin/user-list.tpl');
$page->render();

?>