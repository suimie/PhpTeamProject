<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// get the product id
$id = isset($_GET['pid']) ? $_GET['pid'] : "";
 
// read
$cookie = $_COOKIE['pitstop_cart_items_cookie'];
$cookie = stripslashes($cookie);
$saved_cart_items = json_decode($cookie, true);
 
// remove the item from the array
unset($saved_cart_items[$id]);
 
// delete cookie value
unset($_COOKIE["pitstop_cart_items_cookie"]);
 
// empty value and expiration one hour before
setcookie("pitstop_cart_items_cookie", "", time() - 3600);
 
// enter new value
$json = json_encode($saved_cart_items, true);
setcookie("pitstop_cart_items_cookie", $json, time() + (86400 * 30), '/'); // 86400 = 1 day
$_COOKIE['pitstop_cart_items_cookie']=$json;
 
// redirect to product list and tell the user it was added to cart
//header('Location: cart.php?action=removed&id=' . $id);
header('Location: ../index.php?content=shopping_cart&pid=' . $id . '&action=removed');

die();