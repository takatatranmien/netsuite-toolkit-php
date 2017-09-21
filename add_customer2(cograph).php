<?php

require_once "C:\Users\co-graph\Desktop\preapp\PHPToolkit\NetSuiteService.php";

$service = new NetSuiteService();

$customer = new Customer();
$customer->lastName = "Mien";
$customer->firstName = "Tran";
$customer->companyName = "ABCD company Y ";
$customer->phone = "123456789";

// Set the subsidiary - Must make a reference to it
$sub = new RecordRef();
$sub->internalId = "1";
$sub->type = "subsidiary";

$customer->subsidiary = $sub;

//add record
$request = new AddRequest();
$request->record = $customer;

$addResponse = $service->add($request);

if (!$addResponse->writeResponse->status->isSuccess) {
    echo "ADD ERROR";
    //echo var_dump($addResponse->writeResponse->status->statusDetail[0]->message);
    print $addResponse->writeResponse->status->statusDetail[0]->message;
} else {
    echo "ADD SUCCESS, id " . $addResponse->writeResponse->baseRef->internalId;
}

?> 

