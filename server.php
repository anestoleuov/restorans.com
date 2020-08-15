<?php
// comment;
if ($_POST['form']=="searchRestorans") {
    $json = $_REQUEST['json'];
    $decoded = json_decode($json, true);
    $result = getRestoransList();
    $row = [];
    while ($r = mysqli_fetch_assoc($result)) {
        $row[]=$r;
    }
    echo json_encode($row);
}
if ($_POST['form']=="putOrder") {
    $json = $_REQUEST['json'];
    $decoded = json_decode($json, true);
    var_export($decoded);

    $fTel = $decoded['fTel'];
    $fRestoranID = $decoded['fRestoranID'];
    $fPersonCount = $decoded['fPersonCount'];
    $fDateStart = $decoded['fDateStart'];
    $fDateFinish = $decoded['fDateFinish'];

    setOrder($fTel, $fRestoranID, $fPersonCount, $fDateStart, $fDateFinish);
    //var_export($decoded['fDuration']);
}
if ($_POST['form']=="getOrdersList") {
    $result = getOrdersList();
    $row = [];
    while ($r = mysqli_fetch_assoc($result)) {
        $row[]=$r;
    }
    echo json_encode($row);
}


function getDbLink(){
    define('DBHOST','localhost');
    define('DBLOGIN','mysql');
    define('DBPASSWORD','mysql');
    define('DBNAME','party_schedule');
    return mysqli_connect(DBHOST, DBLOGIN, DBPASSWORD, DBNAME);
}
function setOrder(int $tel, int $restoran_id, int $person_quantity, int $date_start, int $date_finish) {
    $link=getDbLink();
    $query="INSERT INTO `orders` (`zakaz_tel`, `restoran_id`, `person_quantity`, `date_start`, `date_finish`, `created_date`) VALUES ($tel, $restoran_id, $person_quantity, $date_start, $date_finish, current_timestamp());";
    if ($result = mysqli_query($link, $query)) {
        echo "Order inserted OK";
    } else {
        echo "Error on insert Order";
    }

}
function getRestoransList()
{
    $link = getDbLink();
    $query = "SELECT * FROM `restorans`";
    if ($result = mysqli_query($link, $query)) {
        if ($result) {
            // Cycle through results
            return $result;
        } else {
            echo "Something wrong with DB";
        }
        mysqli_close($link);
    }
}
function getOrdersList()
{
    $link = getDbLink();
    $query = "SELECT * FROM `orders`";
    if ($result = mysqli_query($link, $query)) {
        if ($result) {
            return $result;
        } else {
            echo "Something wrong with DB";
        }
        mysqli_close($link);
    }
}
