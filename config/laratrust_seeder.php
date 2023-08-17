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
            'country' => 'c,r,u,d',
            'state' => 'c,r,u,d',
            'city' => 'c,r,u,d',
              'major' => 'c,r,u,d',
            'category' => 'c,r,u,d',
            'subcategory' => 'c,r,u,d',
              'item' => 'c,r,u,d',
            'incomes' => 'c,r,u,d',
            'seller' => 'c,r,u,d',
              'offers' => 'c,r,u,d',
            'expensetype' => 'c,r,u,d',
            'collectionstypes' => 'c,r,u,d',
             'expenses' => 'c,r,u,d',
            'workschedule' => 'c,r,u,d',
            'expenseemployee' => 'c,r,u,d',
            'employee'=> 'c,r,u,d',
             'zone'=> 'c,r,u,d',
             'driver'=> 'c,r,u,d',
        ],
        'admin' => [
           
        ],
       
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
