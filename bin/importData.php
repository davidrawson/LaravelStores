<?php

$con = mysqli_connect('127.0.0.1', 'root', '', 'StoresApp');

if (!$con) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    exit;
}

echo "Host information: " . mysqli_get_host_info($con) . PHP_EOL;

$realpath = realpath(__DIR__);
$xml = simplexml_load_file($realpath . '/stores.xml') or die ('Error: cannot create xml object');

foreach ($xml->children() as $row) {
    $storeNumber = $row->number;
    $storeName = $row->name;
    $address = $row->address->address_line_1 . ', ' . $row->address->address_line_2 .
    ', ' . $row->address->address_line_3 . ', ' . $row->address->city . ', ' .
    $row->address->county . ', ' . $row->address->postcode;
    $siteId = $row->siteid;
    $lat = $row->coordinates->lat;
    $lon = $row->coordinates->lon;
    $phoneNumber = $row->phone_number;
    $cfsFlag = $row->cfs_flag;

    $cfsFlag = validateCfsFlag($cfsFlag);

    $fieldsArray = ['Store Number' => $storeNumber, 'Store Name' => $storeName,
        'Address' => $address, 'Site Id' => $siteId, 'Lat' =>$lat, 'Lon' =>$lon,
        'Phone Number' => $phoneNumber];
    $invalidFields = validateFields($fieldsArray);

    $sql = sprintf('INSERT INTO stores (storeNumber, storeName, address, siteId, lat, lon, phoneNumber, cfsFlag, invalidFields) VALUES ("%s", "%s", "%s", "%s", "%f", "%f", "%s", "%s", "%s");',
        $storeNumber,
        $storeName,
        $address,
        $siteId,
        $lat,
        $lon,
        $phoneNumber,
        $cfsFlag,
        $invalidFields
    );

    $result = mysqli_query($con, $sql);
    printf("%d Row inserted.\n", mysqli_affected_rows($con));
}

mysqli_close($con);

// /**
//  * @param  string  $cfsFlag
//  * @return boolean
//  */
function validateCfsFlag($cfsFlag) {
    if ($cfsFlag === 'Y' || $cfsFlag === 'y') {
        $cfsFlag = 'true';
    } else {
        $cfsFlag = 'false';
    }

    return $cfsFlag;
}

// /**
//  * @param  array  $fieldsArray
//  * @return string
//  */
function validateFields($fieldsArray) {
    $invalidFields = $fieldsArray['Store Number'] . ': ';
    foreach($fieldsArray as $key => $value) {
        if (empty($value) || $value == '' || $value == '0.000000') {
            $invalidFields .= $key . ', ';
        }
    }

    return $invalidFields;
}

?>
