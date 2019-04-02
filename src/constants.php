<?php

/**
 * Stage server api URI
 */
define('STAGE_SERVER_URI', 'https://api.stage.fetchdocs.io/fetch/v1/');

/**
 * Prod server api URI
 */
define('PROD_SERVER_URI', 'https://api.fetchdocs.io/fetch/v1/');

/**
 * API key post field name
 */
define('API_KEY_FIELD_NAME', 'api_key');

/**
 * API checksum post field name
 */
define('API_CHECKSUM_FIELD_NAME', 'api_checksum');

/**
 * API hash algorithm
 */
define('API_HASH_ALGORITHM', 'sha256');


/**
 * List timezones endpoint
 */
define('TIMEZONES_ENDPOINT', 'listTimezones');

/**
 * List environments endpoint
 */
define('ENVIRONMENTS_ENDPOINT', 'listEnvironments');

/**
 * Create environments endpoint
 */
define('CREATE_ENVIRONMENT_ENDPOINT', 'createEnvironment');

/**
 * Update environments endpoint
 */
define('UPDATE_ENVIRONMENT_ENDPOINT', 'updateEnvironment');

/**
 * Delete environments endpoint
 */
define('DELETE_ENVIRONMENT_ENDPOINT', 'deleteEnvironment');

/**
 * List date formats endpoint
 */
define('DATE_FORMATS_ENDPOINT', 'listDateFormats');

/**
 * List customers accounts endpoint
 */
define('LIST_CUSTOMER_ACCOUNTS_ENDPOINT', 'listCustomerAccounts');

/**
 * Create customer account endpoint
 */
define('CREATE_CUSTOMER_ENDPOINT', 'createCustomer');

/**
 * Create customer account endpoint
 */
define('UPDATE_CUSTOMER_ENDPOINT', 'updateCustomer');

/**
 * Delete customer account endpoint
 */
define('DELETE_CUSTOMER_ENDPOINT', 'deleteCustomer');

/**
 * Deactivate customer account endpoint
 */
define('DEACTIVATE_CUSTOMER_ENDPOINT', 'deactivateCustomer');

/**
 * Activate customer account endpoint
 */
define('ACTIVATE_CUSTOMER_ENDPOINT', 'activateCustomer');

/**
 * Get customer account overview endpoint
 */
define('GET_CUSTOMER_ACCOUNT_OVERVIEW_ENDPOINT', 'getCustomerAccountOverview');

/**
 * Get customer session endpoint
 */
define('GET_CUSTOMER_SESSION_ENDPOINT', 'getCustomerSession');

/**
 * Destroy customer session endpoint
 */
define('DESTROY_CUSTOMER_SESSION_ENDPOINT', 'destroyCustomerSession');

/**
 * List Suppliers session endpoint
 */
define('LIST_SUPPLIERS_ENDPOINT', 'listSuppliers');

/**
 * Create Customer Supplier endpoint
 */
define('CREATE_CUSTOMER_SUPPLIER_ENDPOINT', 'createCustomerSupplier');

/**
 * Delete Customer Supplier endpoint
 */
define('DELETE_CUSTOMER_SUPPLIER_ENDPOINT', 'deleteCustomerSupplier');

/**
 * Delete Customer Supplier endpoint
 */
define('LIST_CUSTOMER_SUPPLIERS_ENDPOINT', 'listCustomerSuppliers');

/**
 * Update Customer Supplier endpoint
 */
define('UPDATE_CUSTOMER_SUPPLIER_ENDPOINT', 'updateCustomerSupplier');

/**
 * Fill input request endpoint
 */
define('FILL_INPUT_REQUEST_ENDPOINT', 'fillInputRequest');

/**
 * Fill Quick Feedback request endpoint
 */
define('FILL_QUICK_FEEDBACK_REQUEST', 'fillQuickFeedbackRequest');

/**
 * Get Supplier Fields endpoint
 */
define('GET_SUPPLIER_FIELDS', 'getSupplierFields');

/**
 * Get Document Queue endpoint
 */
define('GET_DOCUMENT_QUEUE', 'getDocumentsQueue');

/**
 * Get Document endpoint
 */
define('GET_DOCUMENT', 'getDocument');

/**
 * Remove Document From Queue endpoint
 */
define('REMOVE_DOCUMENT_FROM_QUEUE', 'removeDocumentFromQueue');

/**
 * Test password encryption endpoint
 */
define('TEST_PASSWORD_ENCRYPTION_ENDPOINT', 'testPasswordEncryption');

/**
 * Test password encryption endpoint
 */
define('TEST_QUEUE_DOCUMENT_ENDPOINT', 'testQueue');
