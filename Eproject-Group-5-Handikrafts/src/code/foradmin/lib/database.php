<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "handicraft");

function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

$db = db_connect();


function db_disconnect($connection) {
    if(isset($connection)) {
      mysqli_close($connection);
    }
}

function confirm_query_result($result){
    global $db;
    if (!$result){
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    } else {
        return $result;
    }
}

function insert_Admin($Admin) {
    global $db;

    $sql = "INSERT INTO Admin ";
    $sql .= "(AdminName,Password) ";
    $sql .= "VALUES (";
    $sql .= "'" . $Admin['AdminName'] . "',";
    $sql .= "'".$Admin['Password'] ."'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function find_all_Admin(){
    global $db;

    $sql = "SELECT * FROM Admin ";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}

function find_Admin_by_AdminName($id) {
    global $db;

    $sql = "SELECT * FROM Admin ";
    $sql .= "WHERE AdminName ='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $Admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $Admin;
}

function update_Admin($Admin) {
    global $db;

    $sql = "UPDATE Admin SET ";
    $sql .= "AdminName='" . $Admin['AdminName'] . "',";
    $sql .= "Password='".$Admin['Password']."' ";
    $sql .= "WHERE AdminID='" . $Admin['AdminID'] . "' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function delete_Admin($id) {
    global $db;

    $sql = "DELETE FROM Admin ";
    $sql .= "WHERE AdminID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}
function insert_categories($category) {
    global $db;

    $sql = "INSERT INTO categories ";
    $sql .= "(name) ";
    $sql .= "VALUES (";
    $sql .= "'" . $category['name'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function find_all_categories(){
    global $db;

    $sql = "SELECT * FROM categories ";
    $sql .= "ORDER BY name";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}

function find_categories_by_id($id) {
    global $db;

    $sql = "SELECT * FROM categories ";
    $sql .= "WHERE CatID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $category = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $category;
}

function update_categories($category) {
    global $db;

    $sql = "UPDATE categories SET ";
    $sql .= "Name='" . $category['Name'] . "' ";
    $sql .= "WHERE CatID='" . $category['CatID'] . "' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function delete_categories($id) {
    global $db;

    $sql = "DELETE FROM categories ";
    $sql .= "WHERE CatID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}

function insert_faqs($faqs) {
    global $db;

    $sql = "INSERT INTO faqs ";
    $sql .= "(Question,Answer) ";
    $sql .= "VALUES (";
    $sql .= "'" . $faqs['Question'] . "',";
    $sql .= "'".$faqs['Answer'] ."'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function find_all_faqs(){
    global $db;

    $sql = "SELECT * FROM faqs ";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}

function find_faqs_by_id($id) {
    global $db;

    $sql = "SELECT * FROM faqs ";
    $sql .= "WHERE FAQsID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $faqs = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $faqs;
}

function update_faqs($faqs) {
    global $db;

    $sql = "UPDATE faqs SET ";
    $sql .= "Question='" . $faqs['Question'] . "',";
    $sql .= "Answer='".$faqs['Answer']."' ";
    $sql .= "WHERE FAQsID='" . $faqs['FAQsID'] . "' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function delete_faqs($id) {
    global $db;

    $sql = "DELETE FROM faqs ";
    $sql .= "WHERE FAQsID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}
function insert_products($product) {
    global $db;

    $sql = "INSERT INTO Products ";
    $sql .= "(Name,CatID,Image,Price,Quantity,Information) ";
    $sql .= "VALUES (";
    $sql .= "'" . $product['name'] . "',";
    $sql .= "'" . $product['CatID'] . "',";
    $sql .= "'" . $product['Image'] . "',";
    $sql .= "'" . $product['Price'] . "',";
    $sql .= "'" . $product['Quantity'] . "',";
    $sql .= "'" . $product['information'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function find_all_products(){
    global $db;

    $sql = "SELECT * FROM products ";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}
function find_top6_products(){
    global $db;

    $sql = "SELECT * FROM products Order by Rand() LIMIT 6";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}

function find_products_by_id($id) {
    global $db;

    $sql = "SELECT * FROM products ";
    $sql .= "WHERE ProductID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $product = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $product;
}
function find_products_by_CatID($id) {
    global $db;

    $sql = "SELECT * FROM products ";
    $sql .= "WHERE CatID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);;
}
function find_products_by_Name($name) {
    global $db;

    $sql = "SELECT * FROM products ";
    $sql .= "WHERE Name like'%" . $name . "%'";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);;
}
function find_products_by_CatIDandName($id,$name) {
    global $db;

    $sql = "SELECT * FROM products ";
    $sql .= "WHERE CatID='" . $id . "' and Name like '%".$name."%'";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);;
}
function update_products($product) {
    global $db;

    $sql = "UPDATE products SET ";
    $sql .= "Name='" . $product['Name'] . "', ";
    $sql .= "CatID='" . $product['CatID'] . "', ";
    $sql .= "Image='" . $product['Image'] . "', ";
    $sql .= "Price='" . $product['Price'] . "', ";
    $sql .= "Quantity='" . $product['Quantity'] . "', ";
    $sql .= "Information='" . $product['Information'] . "' ";
    $sql .= "WHERE ProductID='" . $product['ProductID'] . "' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function update_quantity_product_in_ID($id,$quantity){
    global $db;

    $sql = "UPDATE products SET ";
    $sql .= "Quantity='" . $quantity . "' ";
    $sql .= "WHERE ProductID='" . $id . "' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function delete_products($id) {
    global $db;

    $sql = "DELETE FROM products ";
    $sql .= "WHERE ProductID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}
function insert_shipper($shipper) {
    global $db;

    $sql = "INSERT INTO Shipper ";
    $sql .= "(CompanyName,Phone) ";
    $sql .= "VALUES (";
    $sql .= "'" . $shipper['CompanyName'] . "',";
    $sql .= "'".$shipper['Phone'] ."'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function find_all_shipper(){
    global $db;

    $sql = "SELECT * FROM shipper ";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}

function find_shipper_by_id($id) {
    global $db;

    $sql = "SELECT * FROM shipper ";
    $sql .= "WHERE ShipperID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $shipper = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $shipper;
}

function update_shipper($shipper) {
    global $db;

    $sql = "UPDATE shipper SET ";
    $sql .= "CompanyName='" . $shipper['CompanyName'] . "',";
    $sql .= "Phone='".$shipper['Phone']."' ";
    $sql .= "WHERE ShipperID='" . $shipper['ShipperID'] . "' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function delete_shipper($id) {
    global $db;

    $sql = "DELETE FROM shipper ";
    $sql .= "WHERE ShipperID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}
function insert_orderdetail($Order) {
    global $db;
    $sql = "INSERT INTO orderdetail ";
    $sql .= "(OrderID,ProductID,Quantity,Price) ";
    $sql .= "VALUES (";
    $sql .= "'" . $Order['orderID'] . "',";
    $sql .= "'" . $Order['productID'] . "',";
    $sql .= "'" . $Order['quantity'] . "',";
    $sql .= "'" . $Order['price'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function find_all_orderdetail(){
    global $db;

    $sql = "SELECT * FROM orderdetail ";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}
function delete_orderdetail($id) {
    global $db;

    $sql = "DELETE FROM orderdetail ";
    $sql .= "WHERE ID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}
function find_orderdetail_by_id($id) {
    global $db;

    $sql = "SELECT * FROM orderdetail ";
    $sql .= "WHERE ID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $Order = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $Order;
}
function find_orderdetail_by_Orderid($id) {
    global $db;

    $sql = "SELECT * FROM orderdetail ";
    $sql .= "WHERE OrderID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function insert_Order($Order) {
    global $db;
    $sql = "INSERT INTO Orders ";
    $sql .= "(OrderID,CusID,Price,Status,OrderDate) ";
    $sql .= "VALUES (";
    $sql .= "'" . $Order['OrderID'] . "',";
    $sql .= "'" . $Order['CusID'] . "',";
    $sql .= "'" . $Order['Price'] . "',";
    $sql .= "'" . $Order['Status'] . "',";
    $sql .= "'" . $Order['OrderDate'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function find_last_OrderID(){
    global $db;

    $sql = "SELECT OrderID FROM Orders Order By OrderID DESC LIMIT 1";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}
function find_all_Order(){
    global $db;

    $sql = "SELECT * FROM Orders ";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}

function find_Order_by_id($id) {
    global $db;

    $sql = "SELECT * FROM Orders ";
    $sql .= "WHERE OrderID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $customer = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $customer;
}
function find_Order_by_Username($name) {
    global $db;

    $sql = "SELECT Orders.OrderID,Customer.Address,Customer.Name,Orders.OrderDate,Orders.Shipdate,Orders.Price,Orders.Status FROM Orders ";
    $sql .= "join Customer on Orders.CusID = Customer.CusID ";
    $sql .= "WHERE UserName='" . $name . "'";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function update_Order($Order) {
    global $db;

    $sql = "UPDATE orders SET ";
    $sql .= "CusID='" . $Order['CusID'] . "',";
    $sql .= "OrderDate='" . $Order['OrderDate'] . "',";
    $sql .= "Shipdate='" . $Order['Shipdate'] . "',";
    $sql .= "Price='" . $Order['Price'] . "',";
    $sql .= "Status='" . $Order['Status'] . "',";
    $sql .= "ShipperID='".$Order['ShipperID']."' ";
    $sql .= "WHERE OrderID='" . $Order['OrderID'] . "' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function update_Order_price($Order) {
    global $db;

    $sql = "UPDATE orders SET ";
    $sql .= "Price='" . $Order['Price'] . "'";
    $sql .= "WHERE OrderID='" . $Order['OrderID'] . "' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function delete_Order($id) {
    global $db;

    $sql = "DELETE FROM orders ";
    $sql .= "WHERE OrderID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}
function insert_customer($customer) {
    global $db;

    $sql = "INSERT INTO customer ";
    $sql .= "(UserName,Password,Name,Age,Gender,Address,Phone,Email) ";
    $sql .= "VALUES (";
    $sql .= "'" . $customer['UserName'] . "',";
    $sql .= "'" . $customer['Password'] . "',";
    $sql .= "'" . $customer['Name'] . "',";
    $sql .= "'" . $customer['Age'] . "',";
    $sql .= "'" . $customer['Gender'] . "',";
    $sql .= "'" . $customer['Address'] . "',";
    $sql .= "'" . $customer['Phone'] . "',";
    $sql .= "'" . $customer['Email'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function find_all_customer(){
    global $db;

    $sql = "SELECT * FROM customer ";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}
function update_Password_Customer($Customer) {
    global $db;

    $sql = "UPDATE Customer SET ";
    $sql .= "Password='" . $Customer['Password'] . "' ";
    $sql .= "WHERE CusID='" . $Customer['CusID'] . "' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function update_Customer($Customer) {
    global $db;

    $sql = "UPDATE Customer SET ";
    $sql .= "Name='" . $Customer['Name'] . "',";
    $sql .= "Age='" . $Customer['Age'] . "',";
    $sql .= "Gender='" . $Customer['Gender'] . "',";
    $sql .= "Address='" . $Customer['Address'] . "',";
    $sql .= "Phone='" . $Customer['Phone'] . "',";
    $sql .= "Email='".$Customer['Email']."' ";
    $sql .= "WHERE CusID='" . $Customer['CusID'] . "' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function find_all_contact(){
    global $db;

    $sql = "SELECT * FROM Contact";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}
function find_customer_by_id($id) {
    global $db;

    $sql = "SELECT * FROM customer ";
    $sql .= "WHERE CusID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $customer = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $customer;
}

function find_customer_by_UserName($name) {
    global $db;

    $sql = "SELECT * FROM customer ";
    $sql .= "WHERE UserName ='" . $name . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $UserName = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $UserName;
}
function delete_customer($id) {
    global $db;

    $sql = "DELETE FROM customer ";
    $sql .= "WHERE CusID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}
function select_categories($name){
    global $db;

    $sql = "SELECT Categories.Name as Category_Name,Categories.CatID as Category_CatID,count(Products.CatID) as Quantity_Of_Product ";
    $sql .= "FROM Categories LEFT join Products on Categories.CatID = Products.CatID ";
    $sql .= "WHERE Categories.Name like '%".$name."%' or categories.CatID='".$name."' ";
    $sql .= "Group By Categories.Name order by Categories.CatID";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);;
}
function find_product_by_name($name){
    global $db;

    $sql = "select * from products where Name='".$name."';";
    
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $Product = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $Product;
}
function select_Products($name){
    global $db;

    $sql = "SELECT Products.ProductID,Products.Name as Products_Name,Categories.Name as Category_Name,Products.Image,Products.Price,Products.Information ";
    $sql .= "FROM Categories LEFT join Products on Categories.CatID = Products.CatID ";
    $sql .= "WHERE Products.Name like '%".$name."%' or Products.ProductID='".$name."'";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);;
}
function select_Orderdetail($name){
    global $db;

    $sql = "SELECT Orders.OrderID,Customer.Name as Customer_Name,Customer.Address ,Customer.Phone,Orders.Price,Orders.OrderDate,Orders.Shipdate  ";
    $sql .= "FROM Orders ";
    $sql .= " join Customer on Orders.CusID = Customer.CusID ";
    $sql .= "WHERE Orders.CusID = '%".$name."%' or Orders.OrderID like '%".$name."%'";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);;
}
function select_Shipper($name){
    global $db;

    $sql = "SELECT * ";
    $sql .= "FROM Shipper ";
    $sql .= "WHERE CompanyName like '%".$name."%' or ShipperID='".$name."' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);;
}
function select_FAQs($name){
    global $db;

    $sql = "SELECT * ";
    $sql .= "FROM FAQs ";
    $sql .= "WHERE Question like '%".$name."%' or FAQsID='".$name."' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);;
}
function select_customer($name){
    global $db;

    $sql = "SELECT * ";
    $sql .= "FROM customer ";
    $sql .= "WHERE Name like '%".$name."%' or CusID='".$name."' ";

    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);;
}
function select_Products_byID($id){
    global $db;

    $sql = "SELECT Products.* , Categories.Name as CategoryName ";
    $sql .= "FROM Categories join Products on Categories.CatID = Products.CatID ";
    $sql .= "WHERE Products.ProductID='".$id."'";

    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $product = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $product;
}
function insert_Contact($Contact) {
    global $db;

    $sql = "INSERT INTO Contact ";
    $sql .= "(Email,Name,Question) ";
    $sql .= "VALUES (";
    $sql .= "'".$Contact['Email'] ."',";
    $sql .= "'" . $Contact['Name'] . "',";
    $sql .= "'" . $Contact['Question'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}
function delete_Contact($id) {
    global $db;

    $sql = "DELETE FROM Contact ";
    $sql .= "WHERE ContactID='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}
function find_Contac_by_id($id) {
    global $db;

    $sql = "SELECT * FROM Contact ";
    $sql .= "WHERE ContactID='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $Contact = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $Contact;
}
?>