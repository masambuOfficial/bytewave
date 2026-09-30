<?php

/*
| Staff roles: who can see and do what in the admin panel.
|
| A role lists the modules it can open (routes are guarded by the `module:<name>` middleware and the
| sidebar hides the rest). Owner has "*" (everything, including staff management).
|
| Money rule: only Owner and Accounts get the `invoices` module (invoices, payments, receipts).
| Sales work with quotations but cannot open invoices or payments, or convert a quotation to an invoice.
*/
return [
    'roles' => [
        'owner' => [
            'label'       => 'Owner',
            'description' => 'Everything, including staff management.',
            'modules'     => ['*'],
        ],
        'accounts' => [
            'label'       => 'Accounts',
            'description' => 'Clients, client services, quotations, invoices, payments and receipts.',
            'modules'     => ['clients', 'client-services', 'quotations', 'invoices'],
        ],
        'sales' => [
            'label'       => 'Sales',
            'description' => 'Clients, client services, tasks and quotations. No invoices or payments.',
            'modules'     => ['clients', 'client-services', 'tasks', 'quotations'],
        ],
        'content' => [
            'label'       => 'Content',
            'description' => 'Website only: products, services, blog, portfolio, testimonials and client logos.',
            'modules'     => ['products', 'services', 'posts', 'portfolios', 'testimonials', 'client-logos'],
        ],
    ],
];
