<?php

return [
    'openApiPath' => '@specs/x_db_type/fresh/mysql/x_db_type_mysql.yaml',
    'generateUrls' => false,
    'generateModels' => true,
    'excludeModels' => [
        'Error',
    ],
    'generateControllers' => false,
    'generateMigrations' => false,
    'generateModelFaker' => true,
];
