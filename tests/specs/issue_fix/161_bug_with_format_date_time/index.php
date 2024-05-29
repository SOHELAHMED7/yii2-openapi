<?php

return [
    'openApiPath' => '@specs/issue_fix/161_bug_with_format_date_time/index.yaml',
    'generateUrls' => false,
    'generateModels' => false,
    'excludeModels' => [
        'Error',
    ],
    'generateControllers' => false,
    'generateMigrations' => true,
    'generateModelFaker' => false, // `generateModels` must be `true` in orde to use `generateModelFaker` as `true`
];

