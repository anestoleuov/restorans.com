<?php
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
}


function getDbLink(){
    define('DBHOST','localhost');
    define('DBLOGIN','mysql');
    define('DBPASSWORD','mysql');
    define('DBNAME','party_schedule');
    return mysqli_connect(DBHOST, DBLOGIN, DBPASSWORD, DBNAME);
}

function setOrder(int $tel, int $restoran_id, int $person_quantity, $date_start, $date_finish) {
    $link=getDbLink();
    $query="INSERT INTO orders ";
}

function getRestoransList()
{
    $link = getDbLink();
    $query = "SELECT * FROM `restorans`";
    if ($result = mysqli_query($link, $query)) {
        if ($result) {
            // Cycle through results
            return $result;
            //mysqli_free_result($result);        }
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
                // Cycle through results
                while ($row = mysqli_fetch_assoc($result)) {
                    var_export($row);
                    echo "<br>";
                }
                mysqli_free_result($result);
            }
        } else {
            echo "Something wrong with DB";
        }
        mysqli_close($link);
    }
