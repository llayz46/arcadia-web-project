<?php

define('_DOMAIN_', getenv('DOMAIN'));
define('_DB_HOST_', getenv('DB_HOST'));
define('_DB_NAME_', getenv('DB_NAME'));
define('_DB_PORT_', getenv('DB_PORT'));
define('_DB_USER_', getenv('DB_USER'));
define('_DB_PASS_', getenv('DB_PASS'));

define('_MONGO_URL_', getenv('MONGO_URL'));
define('_MONGO_DB_', getenv('MONGO_DB'));
define('_MONGO_COLLECTION_', getenv('MONGO_COLLECTION'));

define('_CONTACT_MAIL_', getenv('CONTACT_MAIL'));

define('_AZURE_ACCOUNT_NAME_', getenv('AZURE_ACCOUNT_NAME'));
define('_AZURE_ACCOUNT_KEY_', getenv('AZURE_ACCOUNT_KEY'));

define('_PATH_ASSETS_IMAGES_', 'assets/images/');
define('_PATH_UPLOADS_', 'assets/uploads/');

define('_ALLOWED_EXTENSIONS_', ['jpg', 'jpeg', 'png', 'gif']);