<?php

require __DIR__ . '/../vendor/autoload.php';

use Aws\S3\S3Client;

$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'ap-southeast-1',

    'credentials' => [

        'key'    => 'ISI_ACCESS_KEY',
        'secret' => 'ISI_SECRET_KEY'

    ]

]);

$bucket = 'tanibox-storage-aiman';