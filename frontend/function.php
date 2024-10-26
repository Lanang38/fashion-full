<?php
$sql = "SELECT * FROM products";
$sql_limit = "SELECT * FROM products LIMIT 8";
$sql_categories = "SELECT * FROM categories";
$sql_categories_products = "SELECT * FROM categories";
$all_product = $conection_db->query($sql);
$product_limit = $conection_db->query($sql_limit);
$all_categories = $conection_db->query($sql_categories);
$all_categories_products = $conection_db->query($sql_categories_products);
