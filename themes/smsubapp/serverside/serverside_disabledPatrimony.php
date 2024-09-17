<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See https://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - https://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'patrimonys';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'id', 'dt' => 0),
    array(
        'db'        => 'created_at',
        'dt'        => 1,
        'formatter' => function( $d) {
            return date( 'd/m/Y', strtotime($d));
        }
    ),
    array( 'db' => 'type_part_number', 'dt' => 2),
    array( 'db' => 'part_number', 'dt' => 3),
    array( 'db' => 'product_id', 'dt' => 4),
    array( 'db' => 'product_id', 'dt' => 5),
    array( 'db' => 'user_id', 'dt' => 6),
    array( 'db' => 'user_id', 'dt' => 7),
    array( 'db' => 'user_id', 'dt' => 8),
    array( 'db' => 'user_id', 'dt' => 9),
    array( 'db' => 'unit_id', 'dt' => 10),
    array( 'db' => 'unit_id', 'dt' => 11),
    array( 'db' => 'unit_id', 'dt' => 12),
    array( 'db' => 'observations', 'dt' => 13),
    array( 'db' => 'id', 'dt' => 14),
    array( 'db' => 'id', 'dt' => 15),
    array( 'db' => 'id', 'dt' => 16)
);

// SQL server connection information
$sql_details = array(
    'user' => 'smsubcoti',
    'pass' => ')f9aGXVCh8YqJ8[L',
    'db'   => 'smsub',
    'host' => '192.168.15.54'
    // ,'charset' => 'utf8' // Depending on your PHP and MySQL config, you may need this
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);