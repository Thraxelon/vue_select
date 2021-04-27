<?php

include_once './class/dbh.inc.php';
include_once './class/variables.inc.php';

$received_data = json_decode(file_get_contents("php://input"));
$data = array();
$action = $received_data->action;

switch ($action) {
    case 'getCustomer':
        $src_co_name = $received_data->src_co_name;
        $qrCC = "SELECT cid as id, co_name as name FROM customer_pst WHERE company='PST'"
                . " AND status NOT LIKE 'deleted' AND co_name LIKE '%$src_co_name%' ORDER BY co_name";
        $objSQLCC = new SQL($qrCC);
        $results = $objSQLCC->getResultRowArray();
        echo json_encode($results);
        break;
}
?>
