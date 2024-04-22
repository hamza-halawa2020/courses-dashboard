<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'roles' => 'c,r,u,d',
            'admins' => 'c,r,u,d',
            'owners' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'places' => 'c,r,u,d',
            'apartments'=>'c,r,u,d',
            'posts' => 'c,r,u,d',
            'banners' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'stages' => 'c,r,u,d',
            'courses' => 'c,r,u,d',
            'chapters'=> 'c,r,u,d',
            'lectures'=> 'c,r,u,d',
            'qRvalues'=> 'c,r,u,d',
            'QR'=> 'c,r,u,d',
        ],
        'admin' => [],
        'user' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
