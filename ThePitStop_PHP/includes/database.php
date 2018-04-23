<?php

/**
 * Database connection and CRUD queries
 * 
 */

/** 
 * connect_db
 * Connect DB and Return connection
 * 
 */
function connect_db(){
    $host = 'localhost';
    $user = 'root';
    $pw = '';
    $dbName = 'pitstop';
    $conn = new mysqli($host, $user, $pw, $dbName);
    
    if ($conn) {
        logging("Succeeded  to Connect to  MySQL-" . $conn->connect_error);
        return $conn;
    } else {
        logging("Failed to Connect to MySQL-" . $conn->connect_error);
        return null;
    }
}

/** 
 * disconnect_db
 * Disconnect DB connection
 */
function disconnect_db($conn){
    $conn->close();    
}

/** 
 * get_categories
 * Get All categories list
 */
function get_categories(){
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    $sql = "SELECT DISTINCT(categoryId), category from products";
    logging(__FILE__ . ":" . __LINE__ . $sql);
    $result = $conn->query($sql);
    
    disconnect_db($conn);
    
    if ($result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
        
    return null;
}

/** 
 * get_product_image_src
 * Get brands list
 * 
 */
function get_brands(){
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    $sql = "SELECT DISTINCT(brandId), brand from products";
    logging(__FILE__ . ":" . __LINE__ . $sql);
    $result = $conn->query($sql);
    
    disconnect_db($conn);
    
    if ($result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
        
    return null;
}
/** 
 * get_product_image_src
 * Get brands list with $category
 * @param $category
 */
function get_brands2($categoryarr){
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    $sql = "SELECT DISTINCT(brandId), brand from products";
    if (count($categoryarr) > 0){
        $sql .= " WHERE ";
        
        $category_where = "";
        foreach($categoryarr as $category){
            logging(__FILE__ . ":" . __LINE__ . $category);
            if($category_where != "")
                $category_where .= " OR ";
            
            $category_where .= "categoryId = '" . $category . "'";
        }
        
        $sql .= $category_where;
    }
    
    logging(__FILE__ . ":" . __LINE__ . $sql);
    $result = $conn->query($sql);
    
    disconnect_db($conn);
    
    if ($result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
        
    return null;
}


/** 
 * get_products
 * Get products list with $category and $brand
 * $category contain categoryId
 * $$brand contain brandId
 * @param $category, $brand
 * 
 */
function get_products($categoryarr, $brandarr){
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    $sql = "SELECT * from products ";
    if (count($categoryarr) > 0 || count($brandarr) >0){
        $category_where = "";
        foreach($categoryarr as $category){
            if ($category == "")   continue;
            logging(__FILE__ . ":" . __LINE__ . $category);
            if($category_where != "")
                $category_where .= " OR ";
            
            $category_where .= "categoryId = '" . $category . "'";
        }
        
        $brand_where = "";
        foreach($brandarr as $brand){
            if ($brand == "")   continue;
            
            logging(__FILE__ . ":" . __LINE__ . $brand);
            if($brand_where != "")
                $brand_where .= " OR ";
            
            $brand_where .= "brandId = '" . $brand . "'";
        }
        
        logging(__FILE__ . ":" . __LINE__ . $category_where);        
        logging(__FILE__ . ":" . __LINE__ . $brand_where);
        //if ($category_where != "" and $brand_where != "")
        if (strpos($category_where, 'category') !== false && strpos($brand_where, 'brand') !== false) {
            logging(__FILE__ . ":" . __LINE__ . $category_where . ", " . $brand_where); 
            $sql .= "WHERE (" . $category_where . ") AND (" . $brand_where . ")";
        //else if ($category_where != ""){
        }else if(strpos($category_where, 'category') !== false){
            logging(__FILE__ . ":" . __LINE__ . $category_where); 
            $sql .= "WHERE " . $category_where;
        }else if(strpos($brand_where, 'brand') !== false){
            logging(__FILE__ . ":" . __LINE__ . $brand_where); 
            $sql .= "WHERE " . $brand_where;
        }
    }
    
    logging(__FILE__ . ":" . __LINE__ . $sql);
    $result = $conn->query($sql);
    
    disconnect_db($conn);
    
    if ($result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
        
    return null;
}

/** 
 * get_products
 * Get products list with $category and $brand
 * $category contain categoryId
 * $$brand contain brandId
 * @param $category, $brand
 * 
 */
function get_product_detail($pids){
    $conn = connect_db();
    if($conn === null){
        return null;
    }
    
    if (!is_array($pids) && $pid == "") return null;
    
    $sql = "SELECT * from products ";
    $where = "";
    foreach($pids as $pid){
        if ($pid != "")
            if ($where != "")
                $where .= " OR ";
            $where .= "pId='" . $pid . "'";
    }
    
    if($where != ""){
        $sql .= "WHERE " . $where;
    }
    
    $result = $conn->query($sql);
    
    disconnect_db($conn);
    
    if ($result->num_rows > 0) {
        // output data of each row
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } 
    
    
    return null;
}
