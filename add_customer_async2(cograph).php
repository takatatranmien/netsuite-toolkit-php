<?php

require_once "C:\Users\co-graph\Desktop\preapp\PHPToolkit\NetSuiteService.php";

$service = new NetSuiteService();

$customer1 = new Customer();

$customer1->name = 'customer_php_async_1';
$customer1->companyName = 'mono_kaisha_1';
$customer1->externalId = 'customer_php_async_1';

// Set the subsidiary - Must make a reference to it
$sub = new RecordRef();
$sub->internalId = "1";
$sub->type = "subsidiary";

$customer1->subsidiary = $sub;

// Set the subsidiary - Must make a reference to it
$sub2 = new RecordRef();
$sub2->internalId = "1";
$sub2->type = "subsidiary";

// create Customer record 2
$customer2 = new Customer();

$customer2->name = 'customer_php_async_2';
$customer2->companyName = 'mono_kaisha_2';
$customer2->externalId = 'customer_php_async_2';

$customer2->subsidiary = $sub2;

// perform async add operation
$asyncreq = new AsyncAddListRequest();
$asyncreq->record = array($customer1, $customer2);
$checkAsync = $service->asyncAddList($asyncreq);

// get job id
$jobId = $checkAsync->asyncStatusResult->jobId;
$checkasyncreq = new CheckAsyncStatusRequest();
$checkasyncreq->jobId = $jobId;

while ($checkAsync->asyncStatusResult->status == 'pending' || $checkAsync->asyncStatusResult->status == 'processing') {
    echo 'CURRENT STATUS: ' . $checkAsync->asyncStatusResult->status . "\n";
    sleep(10);
    $checkAsync = $service->checkAsyncStatus($checkasyncreq);
}

// once it is done processing, get the result
$getasyncreq = new GetAsyncResultRequest();
$getasyncreq->jobId = $jobId;
$getasyncreq->pageIndex = "1";

$result = $service->getAsyncResult($getasyncreq);

echo 'CURRENT STATUS:　－－－－－－ 完了　－－－－－－';

?> 
