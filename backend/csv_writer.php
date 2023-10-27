<?php
$csv_file = __DIR__.'/sales_data.csv';


function addSale($data) {
    global $csv_file;
    $csv_file = fopen($csv_file,'w');
    #write data into csv
    fputcsv($csv_file, $data);
}
?>