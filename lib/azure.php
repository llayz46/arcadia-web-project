<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once 'config.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\CreateBlobBlockOptions;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

$connection = "DefaultEndpointsProtocol=https;AccountName="._AZURE_ACCOUNT_NAME_.";AccountKey="._AZURE_ACCOUNT_KEY_."EndpointSuffix=core.windows.net";

$blobClient = BlobRestProxy::createBlobService($connection);