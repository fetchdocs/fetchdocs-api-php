##Overview  
fetchdocs.io - Fetch API can be used for the API-Based integration of document fetching as well as for the UI Plug&Play Integration.
<br>All Access to the APIs are restricted by an API Key. Request your access on https://www.fetchdocs.io by submitting the contact form.
- - -
##Fetchdocs PHP SDK Client<br>
The fetch php sdk client enables you to work with fetchdocs API you can check API documentation following this [link](https://docs.fetchdocs.io/api/v1/index.html)

---
##Installation

1. Run `composer require fetchdocs/fetchdocs-api-php`.
2. Include  `require_once '/path/to/your-project/vendor/autoload.php';`  to your index file

---

Examples
---
####1.Get Document

```php
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
```
##SDK API
- Please check API documentation for more information about request parameters and expected response following this [link](https://docs.fetchdocs.io/api/v1/index.html)
- Please note that each client method returns a `STD Object` mapping the API response 
#####1. Use Production Server

```php
$client = \Fetchdocs\SDKClient\Client::make('Your API Key', 'Your Hash Key');
```

#####2. Use Stage Server

```php
$client = \Fetchdocs\SDKClient\Client::make('Your Stage API Key', 'Your Stage Hash Key', true);
```

#####3. List Environments

```php
$client->environments();
```

```json
[
    {
        prim_uid: "10361",
        name: "Default",
        push_document_url: "",
        push_notification_url: "https://push.domain.tld/notifications/",
        push_input_request_url: "https://push.domain.tld/input_request/",
        ui_redirect_url: "",
        default_environment: true
    },
    {
        prim_uid: "10362",
        name: "Env",
        push_document_url: "",
        push_notification_url: "https://push.domain.tld/notifications/",
        push_input_request_url: "https://push.domain.tld/input_request/",
        ui_redirect_url: "",
        default_environment: false
    }
]
```
#####4.List Timezones
```php
$client->timezones();
```
```json
[
    "Africa/Abidjan",
    "Africa/Accra",
    ...
]
```
#####5.Date Formats
```php
$client->dateFormats();
```
```json
[
    "d.m.Y",
    "m/d/Y",
    "d/m/Y"
]
```
#####6.Create Environment
```php
$client->createEnvironment([
    'name' => 'Environment Name',
    'default_environment' => true,
    'push_notification_url' => 'https://push.domain.tld/notifications/',
    'push_input_request_url' => 'https://push.domain.tld/input_request/'
]);
```
```json
{
    prim_uid: 10432
}
```
#####7.Update Environment
```php
$client->updateEnvironment([
    'prim_uid' => $environment->prim_uid,
    'name' => 'New Name'
])
```
```json
{
    success: true
}
```
#####8.Delete Environment
```php
$client->deleteEnvironment([
   'prim_uid' => $environment->prim_uid,
])
```
```json
{
    success: true
}
```
#####9.List Customers Accounts
```php
$client->listCustomerAccounts([
    'environment_prim_uid' => 10361
])
```
```json
[
    {
        "prim_uid": 1, 
        "language": "en",
        "timezone": "Europe/Berlin",
        "date_format": "m/d/Y",
        "environment": 144 
    }
]
```
#####10.Create Customer
```php
$client->createCustomer([
   'environment_prim_uid' => $environment->prim_uid
]);
```
```json
{
    prim_uid: 6684,
    customer_secret: "b3cjpcy8",
    access_token: "o1zhz0yzrbx3i5v65j20a751rrg6tyji"
}
```
#####11.Update Customer
```php
$client->updateCustomer([
   'prim_uid' => '10500',
   'customer_secret' => 'Customer Secret',
   'language' => 'de'
])
```
```json
{
    success: true
}
```
#####12.Delete Customer
```php
$client->deleteCustomer([
   'prim_uid' => '10500',
   'customer_secret' => 'Customer Secret',
])
```
```json
{
    success: true
}
```
#####12.Deactivate Customer
```php
$client->deactivateCustomer([
   'prim_uid' => '10500',
   'customer_secret' => 'Customer Secret',
])
```
```json
{
    success: true
}
```
#####12.Activate Customer
```php
$client->activateCustomer([
   'prim_uid' => '10500',
   'customer_secret' => 'Customer Secret',
])
```
```json
{
    success: true
}
```
#####13.Get Customer Account Overview
```php
$client->->getCustomerAccountOverview([
 'prim_uid' => '10500',
])
```
```json
{
    "customer_data": {
        "prim_uid": 1, 
        "language": "en", 
        "timezone": "Europe/Berlin", 
        "date_format": "m/d/Y" 
    },
    "customer_suppliers": [
        { 
            "prim_uid": 307,
            "name": "1&1.de"
        }
    ]
}
```
#####14.Get Customer Session
```php
$client->getCustomerSession([
   'prim_uid' => $customer->prim_uid,
   'customer_secret' => $customer->customer_secret
])
```
```json
{
    prim_uid: 6690,
    access_token: "Access Token"
}
```
#####15.Destroy Customer Session
```php
$client->destroyCustomerSession([
    'access_token => "Access Token"
])
```
```json
{
    success: true
}
```
#####16.List Suppliers
```php
$client->->listSuppliers()
```
```json
[
    {
        prim_uid: 2568,
        name: "1&1 - Versatel (Business-Kunden)",
        created: "2018-02-12 12:52:38",
        supplier_login_url: "https://online-rechnung.versatel.de/tb/telcobill.faces",
        supplier_logo_url: "https://portal-ui-images.s3.eu-central-1.amazonaws.com/logo/120x120/25206.jpg",
        document_type: "invoice",
        quick_feedback_supported: false
    },
    ...
]
```
#####17.Create Customer Supplier
```php
$client->createCustomerSupplier([
    'customer_prim_uid' => 10050,
    'supplier_prim_uid' => 2568,
    'active' => true,
    'username' => 'CustomerSupplier',
    'password' => 'PASSWORD'
], 'Encryption-Key');

```
```json
{
    "success": true,
    "customer_supplier_prim_uid": 13,
}

If quick_feedback parameter is set as true

{
    "success": true,
    "quick_feedback_started": true,
    "feedback_process_uid": 12
}
```
#####18.Delete Customer Supplier
```php
$client->deleteCustomerSupplier([
    'prim_uid' => '15000'
])
```
```json
{
    success: true
}
```
#####19.List Customer Suppliers
```php
$client->listCustomerSuppliers([
    'prim_uid' => '10500' //customer uid
])
```
```json
[
    {
        "prim_uid": 2355,
        "supplier_name": "1&1.de",
        "supplier_prim_uid": 307,
        "supplier_logo": "",
        "supplier_logo_url": "", 
        "active": true,
        "input_request_prim_uid": 585, 
        "download_start_date": "2013-07-18", 
        "last_started": "2013-07-18 08:17:13", 
        "next_planned_run": "2013-07-18 10:00:00", 
        "last_status_key": "PENDING", 
        "username": "admin", 
        "document_type": "invoice" 
    }
]
```
#####20.Update Customer Supplier
```php
$client->updateCustomerSupplier([
    'customer_prim_uid' => 10050,
    'supplier_prim_uid' => 2568,
    'active' => true,
    'username' => 'CustomerSupplier',
    'password' => 'PASSWORD'
], 'Encryption-Key');

```
```json
{
    success: true
}
```
#####21.Get Supplier Fields
```php
$client->getSuppliersFields([
    'prim_uid' => '2568'
])
```
```json
[
    {
        "field_key": "USERNAME",
        "label": "Username",
        "help_text": "Here can be any string that can be shown as a help text for the field",
        "mandatory": true,
        "type": "text",
        "dependency": ""
    }, 
    {
        "field_key": "PASSWORD",
        "label": "Password",
        "help_text": "Here can be any string that can be shown as a help text for the field",
        "mandatory": true,
        "type": "password",
        "dependency": "USERNAME" 
    }, 
    {
        "field_key": "LANG",
        "label": "Language",
        "help_text": "",
        "mandatory": false,
        "type": "dropdown",
        "dependency": "",
        "options": "{\"de_de\":\"Deutsch\",\"en_us\":\"English\"}"
    }
]
```
#####22.Get Document Queue
```php
$client->getDocumentQueue([
    'environment_prim_uid' => '15'
]);
```
```json
{
    "count": 100,
    "total": 2345,
    "documents": [
        {
            "prim_uid": 173, 
            "customer_prim_uid": 1, 
            "customer_supplier_prim_uid": 13, 
            "supplier_prim_uid": 307, 
            "filename": "receipt-1708171523.pdf",
            "file_size": 136.75, // File size is always in KB
            "file_content_checksum": "", // md5 hash of file content (raw content, not base64 encoded content)
            "document_type": "invoice" // currently "invoice" and "bank_statement" are supported
        }
    ]
}
```
#####23.Get Document
```php
$client->getDocument([
   'prim_uid' => '102',
   'customer_secret' => 'Customer Secret'
]);
```
```json
{
    "prim_uid": 102,
    "customer_prim_uid": 1, 
    "customer_supplier_prim_uid": 13, 
    "supplier_prim_uid": 307, 
    "filename": "receipt-1708171523.pdf",
    "file_size": "136.75", 
    "file_content_checksum": "", 
    "file_content": "", 
    "document_type": "invoice" 
}
```
#####24. Remove Document From Queue
```php
$client->removeDocumentFromQueue([
    'prim_uid' => $document->prim_uid,
    'customer_secret' => $customer->customer_secret
]);
```
```json
{
    "success": true
}
```