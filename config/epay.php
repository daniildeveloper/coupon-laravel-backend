<?php
return [
    'MERCHANT_CERTIFICATE_ID' => env('KKB_MERCHANT_CERT_ID'),
    'MERCHANT_NAME'           => env('KKB_MERCHANT_NAME'),
    'PRIVATE_KEY_FN'          => base_path('storage/app/kkb/test_prv.pem'),
    'PRIVATE_KEY_PASS'        => env('KKB_PRIVATE_KEY_PATH'),
    'PRIVATE_KEY_ENCRYPTED'   => 1,
    'XML_TEMPLATE_FN'         => base_path('storage/app/kkb/template.xml'),
    'XML_TEMPLATE_CONFIRM_FN' => base_path('storage/app/kkb/command_template.xml'),
    'PUBLIC_KEY_FN'           => base_path('storage/app/kkb/kkbca.pem'),
    'MERCHANT_ID'             => '92061101'
];
