<?php

require '../vendor/autoload.php';

//Client using stage server
$clientStage = \Fetchdocs\SDKClient\Client::make('Your API KEY', 'Your Hash Key', true);

//Create Environment
$environment = $clientStage->createEnvironment([
    'name' => 'Environment Name',
    'default_environment' => true,
    'push_notification_url' => 'Your Push Notification Url',
    'push_input_request_url' => 'Your Push Input Request Url'
]);

//Create a customer
$customer = $clientStage->createCustomer([
    'environment_prim_uid' => $environment->prim_uid
]);


//Supplier
$supplier = getSupplierByName($clientStage, 'Test Portal');

//Create Customer Supplier
$customerSupplier = $clientStage->createCustomerSupplier([
    'customer_prim_uid' => $customer->prim_uid,
    'supplier_prim_uid' => $supplier->prim_uid,
    'active' => true,
    'username' => 'Customer Supplier Username',
    'password' => 'PASSWORD'
], 'Your Encryption Key');

//Push document to document queue
$doc = $clientStage->testQueueDocument([
    'prim_uid' => $customer->prim_uid,
    'customer_supplier_uid' => $customerSupplier->customer_supplier_prim_uid
]);

//Get Documents
$documents = $clientStage->getDocumentsQueue([
    'environment_prim_uid' => $environment->prim_uid
]);

while ($documents->count <= 0) {
    $documents = $clientStage->getDocumentsQueue([
        'environment_prim_uid' => $environment->data->prim_uid
    ]);
}

//Get document
$document = $clientStage->getDocument([
    'prim_uid' => $documents->documents[0]->prim_uid,
    'customer_secret' => $customer->customer_secret
]);

printJson($document);

//Remove document form queue
$deleteDocument= $clientStage->removeDocumentFromQueue([
    'prim_uid' => $document->prim_uid,
    'customer_secret' => $customer->customer_secret
]);

function printJson($data) {
    echo json_encode($data);
}

function getSupplierByName(\Fetchdocs\SDKClient\Client $client, $name) {
    $suppliers = $client->listSuppliers();

    foreach ($suppliers->data as $supplier) {
        if ($supplier->name == $name) {
            return $supplier;
        }
    }

    return null;
}
