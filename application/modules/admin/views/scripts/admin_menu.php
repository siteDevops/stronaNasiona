<?php

$menu = array(
    0 => array(
        'name' => 'Leads',
        'url'  => (Zend_Auth::getInstance()->getIdentity()->group != "admin" && !in_array("admin/lead/list",
                Zend_Auth::getInstance()->getIdentity()->access)) ? array(
            'module'     => 'admin',
            'controller' => 'lead',
            'action'     => 'list-ni'
        ) : array('module' => 'admin', 'controller' => 'lead', 'action' => 'list'),

        'items' => array(
            'Browse all' => array(
                'order'   => 0,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'lead', 'action' => 'list'),
                )
            ),

            'Leads US' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'lead', 'action' => 'list-us')
                )
            ),

            'Leads UK' => array(
                'order'   => 2,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'lead', 'action' => 'list-uk')
                )
            ),

            'Leads AU' => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'lead', 'action' => 'list-au')
                )
            ),

            'Leads CA' => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'lead', 'action' => 'list-ca')
                )
            ),

            'Leads PL' => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'lead', 'action' => 'list-pl')
                )
            ),

            'Leads SA' => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'lead', 'action' => 'list-sa'),
                ),
            ),

            'Leads ZY' => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'lead', 'action' => 'list-zy'),
                ),
            ),

            'Leads NI' => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'lead', 'action' => 'list-ni'),
                ),
            ),

            'Redirections' => array(
                'order'   => 100,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'lead', 'action' => 'list-redirections'),
                )
            ),

            'Leadspinger' => array(
                'order'   => 110,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'leadspinger', 'action' => 'list'),
                )
            ),

            'Leadspinger EM' => array(
                'order'   => 110,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'leadspinger-email-marketer', 'action' => 'list'),
                    array(
                        'module'     => 'admin',
                        'controller' => 'leadspinger-email-marketer',
                        'action'     => 'request-details'
                    )
                )
            ),

            /*	'States reports' => array (
                    'order' => 10,
                    'actions' => array (
                        array('module' => 'admin', 'controller' => 'lead', 'action' => 'report-states')
                    )
                ),

                'Cites reports' => array (
                    'order' => 11,
                    'actions' => array (
                        array('module' => 'admin', 'controller' => 'lead', 'action' => 'report-cities')
                    )
                ),

                'Keywords reports' => array (
                    'order' => 12,
                    'actions' => array (
                        array('module' => 'admin', 'controller' => 'lead', 'action' => 'report-keywords')
                    )
                ),*/

        )
    ),

    100 => array(
        'name' => 'Form data',
        'url'  => array('module' => 'admin', 'controller' => 'aba', 'action' => 'list'),

        'items' => array(
            'ABA' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'aba', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'aba', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'aba', 'action' => 'edit')
                )
            ),

            'Months at Bank' => array(
                'order'   => 2,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'months-at-bank', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'months-at-bank', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'months-at-bank', 'action' => 'edit')
                )
            ),

            'Account types' => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'type-of-account', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'type-of-account', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'type-of-account', 'action' => 'edit')
                )
            ),

            'States' => array(
                'order'   => 4,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'state', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'state', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'state', 'action' => 'edit')
                )
            ),

            'ZIP' => array(
                'order'   => 5,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'zip', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'zip', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'zip', 'action' => 'edit')
                )
            ),

            'Lengths at address' => array(
                'order'   => 6,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'length-at-address', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'length-at-address', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'length-at-address', 'action' => 'edit')
                )
            ),

            'House types' => array(
                'order'   => 7,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'house-type', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'house-type', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'house-type', 'action' => 'edit')
                )
            ),

            'Contact times' => array(
                'order'   => 8,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'contact-time', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'contact-time', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'contact-time', 'action' => 'edit')
                )
            ),

            'Employment status' => array(
                'order'   => 9,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'employment-status', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'employment-status', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'employment-status', 'action' => 'edit')
                )
            ),

            'Monthly incomes' => array(
                'order'   => 10,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'monthly-income', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'monthly-income', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'monthly-income', 'action' => 'edit')
                )
            )
        )
    ),

    20 => array(
        'name' => 'Contents',
        'url'  => array('module' => 'admin', 'controller' => 'page', 'action' => 'list'),

        'items' => array(

            'Services' => array(
                'order'   => 0,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'service', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'service', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'service', 'action' => 'edit'),

                    array('module' => 'admin', 'controller' => 'service', 'action' => 'list-areas'),
                    array('module' => 'admin', 'controller' => 'service', 'action' => 'add-area'),
                    array('module' => 'admin', 'controller' => 'service', 'action' => 'edit-area')
                )
            ),

            'Pages' => array(
                'order'   => 0,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'page', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'page', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'page', 'action' => 'edit')
                )
            ),

            'News' => array(
                'order'   => 2,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'news', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'news', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'news', 'action' => 'edit')
                )
            ),

            'Blog' => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'blog', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'blog', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'blog', 'action' => 'edit')
                )
            ),

            'Categories' => array(
                'order'   => 4,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'content-category', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'content-category', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'content-category', 'action' => 'edit')
                )
            ),

            'E-mail Templates' => array(
                'order'   => 5,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'email-template', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'email-template', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'email-template', 'action' => 'edit')
                )
            ),

            'FAQ' => array(
                'order'   => 6,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'faq', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'faq', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'faq', 'action' => 'edit')
                )
            ),
        )
    ),

    30 => array(
        'name' => 'Creatives ',
        'url'  => array('module' => 'admin', 'controller' => 'creative', 'action' => 'list'),

        'items' => array(
            'List all' => array(
                'order'   => 0,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'creative', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'creative', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'creative', 'action' => 'edit'),
                )
            ),

            'Types' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'creative', 'action' => 'list-types'),
                    array('module' => 'admin', 'controller' => 'creative', 'action' => 'add-type'),
                    array('module' => 'admin', 'controller' => 'creative', 'action' => 'edit-type')
                )
            ),

            'Shapes' => array(
                'order'   => 2,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'creative', 'action' => 'list-shapes'),
                    array('module' => 'admin', 'controller' => 'creative', 'action' => 'add-shape'),
                    array('module' => 'admin', 'controller' => 'creative', 'action' => 'edit-shape')
                )
            ),

            'Sizes' => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'creative', 'action' => 'list-sizes'),
                    array('module' => 'admin', 'controller' => 'creative', 'action' => 'add-size'),
                    array('module' => 'admin', 'controller' => 'creative', 'action' => 'edit-size')
                )
            ),

            'Mailing Templates' => array(
                'order'   => 10,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'mailing-template', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'mailing-template', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'mailing-template', 'action' => 'edit'),
                )
            ),

        )
    ),
    31 => array(
        'name'  => 'Landing Pages',
        'url'   => array('module' => 'admin', 'controller' => 'landing-page', 'action' => 'list'),
        'items' => array(
            'Public Sites' => array(
                'order'   => 100,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'landing-page', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'landing-page', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'landing-page', 'action' => 'edit')
                )
            ),

            'Templates' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'landing-page-template', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'landing-page-template', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'landing-page-template', 'action' => 'edit')
                )
            ),

            'Uploaded templates' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'landing-page-template', 'action' => 'list-uploaded'),

                )
            ),

            'Modules' => array(
                'order'   => 2,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'landing-page-module', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'landing-page-module', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'landing-page-module', 'action' => 'edit')
                )
            ),

            'Websites' => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'landing-page-website', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'landing-page-website', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'landing-page-website', 'action' => 'edit'),
                    array('module' => 'admin', 'controller' => 'landing-page-website', 'action' => 'edit-template'),
                    array('module' => 'admin', 'controller' => 'landing-page-website', 'action' => 'list-modules'),
                    array('module' => 'admin', 'controller' => 'landing-page-website', 'action' => 'edit-module'),
                    array('module' => 'admin', 'controller' => 'landing-page-catalog', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'landing-page-catalog', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'landing-page-catalog', 'action' => 'edit')
                )
            ),

            'Base catalog' => array(
                'order'   => 4,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'landing-page-catalog-base', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'landing-page-catalog-base', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'landing-page-catalog-base', 'action' => 'edit')
                )
            ),

            'Worker Logs ' => array(
                'order'   => 10,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'worker', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'worker', 'action' => 'log-details'),
                )
            ),
        ),
    ),
    32 => array(
        'name' => 'Tools',
        'url'  => array('module' => 'admin', 'controller' => 'creative', 'action' => 'index'),

        'items' => array(
            'Iframes' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'iframe', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'iframe', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'iframe', 'action' => 'edit'),
                    array('module' => 'admin', 'controller' => 'iframe', 'action' => 'manage-styles'),
                    array('module' => 'admin', 'controller' => 'iframe', 'action' => 'add-style'),
                    array('module' => 'admin', 'controller' => 'iframe', 'action' => 'edit-style')
                )
            ),

            'Iframe Templates' => array(
                'order'   => 2,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'iframe-templates', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'iframe-templates', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'iframe-templates', 'action' => 'edit')
                )
            ),

            'Suppression list - emails' => array(
                'order'   => 10,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'unsubscribe', 'action' => 'list'),
                )
            ),

            'Suppression list - phones' => array(
                'order'   => 11,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'unsubscribe-phone', 'action' => 'list'),
                )
            )
        )
    ),

    33 => array(
        'name' => 'API',
        'url'  => array('module' => 'admin', 'controller' => 'server-api', 'action' => 'index'),

        'items' => array(
            'Tokens'       => array(
                'order'   => 0,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'server-api', 'action' => 'list-tokens'),
                    array('module' => 'admin', 'controller' => 'server-api', 'action' => 'add-token'),
                    array('module' => 'admin', 'controller' => 'server-api', 'action' => 'edit-token')
                )
            ),

            /*	'Leads' => array (
                    'order' => 0,
                    'actions' => array (
                        array('module' => 'admin', 'controller' => 'server-api', 'action' => 'leads'),
                        array('module' => 'admin', 'controller' => 'server-api', 'action' => 'test-leads')
                    )
                ),
            */
            'API requests' => array(
                'order'   => 2,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'api-request', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'api-request', 'action' => 'details')
                )
            ),

            'API errors Grouped' => array(
                'order'   => 5,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'lead-error', 'action' => 'list-grouped'),
                )
            ),

            'API errors All' => array(
                'order'   => 10,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'lead-error', 'action' => 'list'),
                )
            ),

            'API SMS usage' => array(
                'order'   => 15,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'server-api-sms', 'action' => 'list'),
                )
            ),
        )
    ),

    50 => array(
        'name' => 'Affiliates',
        'url'  => array('module' => 'admin', 'controller' => 'affiliate', 'action' => 'list'),

        'items' => array(

            'Affiliates' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'affiliate', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'affiliate', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'affiliate-product-commision', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'affiliate', 'action' => 'edit'),
                    array('module' => 'admin', 'controller' => 'affiliate', 'action' => 'set-overwrite-id-for-leads'),
                    array('module' => 'admin', 'controller' => 'affiliate-product-exchange', 'action' => 'manage'),
                )
            ),

            'Summary' => array(
                'order'   => 2,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'affiliate', 'action' => 'summary-list'),
                    array('module' => 'admin', 'controller' => 'affiliate', 'action' => 'details'),

                )
            ),

            'Refferals' => array(
                'order'   => 100,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'affiliate', 'action' => 'list-refferals')
                )
            ),

            'Invitation' => array(
                'order'   => 110,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'invitation', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'invitation', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'invitation', 'action' => 'edit')
                )
            ),

            'Subaccounts' => array(
                'order'   => 200,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'subaccount', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'subaccount', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'subaccount', 'action' => 'edit')
                )
            ),

            'Aliases' => array(
                'order'   => 400,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'aliases', 'action' => 'list'),
                )
            ),

            'Mobile Links' => array(
                'order'   => 440,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'mobile', 'action' => 'links'),
                )
            ),

            'Mobile Tracking' => array(
                'order'   => 450,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'mobile', 'action' => 'tracking'),
                )
            ),

            'Pixelcodes' => array(
                'order'   => 500,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'pixelcode', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'pixelcode', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'pixelcode', 'action' => 'edit')
                )
            ),

            'Affiliate Networks' => array(
                'order' => 550,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'external-aff-networks-reports', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'external-aff-networks-reports', 'action' => 'details')
                )
            )
        )
    ),

    180 => array(
        'name' => 'Users',
        'url'  => array('module' => 'admin', 'controller' => 'administrator', 'action' => 'list'),

        'items' => array(

            'Administrators' => array(
                'order'   => 100,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'administrator', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'administrator', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'administrator', 'action' => 'edit'),
                    array('module' => 'admin', 'controller' => 'administrator', 'action' => 'access'),
                    array('module' => 'admin', 'controller' => 'administrator', 'action' => 'set-affiliates')
                )
            )
        )
    ),

    200 => array(
        'name' => 'Settings',
        'url'  => array('module' => 'admin', 'controller' => 'settings', 'action' => 'index'),

        'items' => array(

            'Meta tags' => array(
                'order'   => 0,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'settings', 'action' => 'meta-tags')
                )
            ),

            'Contact' => array(
                'order'   => 0,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'settings', 'action' => 'contact')
                )
            ),

            'Leadspinger Settings' => array(
                'order'   => 2,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'leadspinger', 'action' => 'list-settings'),
                    array('module' => 'admin', 'controller' => 'leadspinger', 'action' => 'edit-settings'),
                    array('module' => 'admin', 'controller' => 'leadspinger', 'action' => 'add-settings')
                )
            ),

            'Leadspinger URLs' => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'settings', 'action' => 'leadspinger')
                )
            ),

            'Leadspinger EM' => array(
                'order'   => 4,
                'actions' => array(
                    array(
                        'module'     => 'admin',
                        'controller' => 'leadspinger-email-marketer',
                        'action'     => 'list-settings'
                    ),
                    array(
                        'module'     => 'admin',
                        'controller' => 'leadspinger-email-marketer',
                        'action'     => 'edit-settings'
                    ),
                    array('module' => 'admin', 'controller' => 'leadspinger-email-marketer', 'action' => 'add-settings')
                )
            ),

            'API' => array(
                'order'   => 5,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'server-api', 'action' => 'settings')
                )
            ),

            'Redirections' => array(
                'order'   => 5,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'settings', 'action' => 'redirections')
                )
            ),

            'Fields lengths' => array(
                'order'   => 6,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'settings', 'action' => 'fields-length')
                )
            ),

            'Fields helps' => array(
                'order'   => 7,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'field', 'action' => 'list-forms'),
                    array('module' => 'admin', 'controller' => 'field', 'action' => 'add-form'),
                    array('module' => 'admin', 'controller' => 'field', 'action' => 'edit-form'),
                    array('module' => 'admin', 'controller' => 'field', 'action' => 'list-fields')
                )
            ),

            'E-mail Settings' => array(
                'order'   => 8,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'settings', 'action' => 'email')
                )
            ),

            'Translations' => array(
                'order'   => 10,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'language', 'action' => 'translate'),
                    array('module' => 'admin', 'controller' => 'language', 'action' => 'translate2')
                )
            ),

            'Contents' => array(
                'order'   => 11,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'settings', 'action' => 'contents')
                )
            ),

            'Landing Pages' => array(
                'order'   => 12,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'settings', 'action' => 'landing-pages')
                )
            ),

            'Countries' => array(
                'order'   => 13,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'country', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'country', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'country', 'action' => 'edit'),
                    array('module' => 'admin', 'controller' => 'country', 'action' => 'list-access'),
                    array('module' => 'admin', 'controller' => 'country', 'action' => 'add-access'),
                )
            ),

            'Products' => array(
                'order'   => 14,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'product', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'product', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'product', 'action' => 'edit'),
                    array('module' => 'admin', 'controller' => 'product', 'action' => 'list-access'),
                    array('module' => 'admin', 'controller' => 'product', 'action' => 'add-access'),
                    array('module' => 'admin', 'controller' => 'product', 'action' => 'list-exchange'),
                )
            ),

            'Mobile App' => array(
                'order'   => 20,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'settings', 'action' => 'mobile-app')
                )
            ),

            'System settings' => array(
                'order'   => 200,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'system-settings', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'system-settings', 'action' => 'edit')
                )
            ),

            'Black list' => array(
                'order'   => 201,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'blacklist', 'action' => 'list'),
                )
            ),

            'Banned IPs' => array(
                'order'   => 202,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'banned-i-ps', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'banned-i-ps', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'banned-i-ps', 'action' => 'edit'),
                )
            ),

            'IP WhiteList' => array(
                'order'   => 203,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'whitelisted-i-ps', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'whitelisted-i-ps', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'whitelisted-i-ps', 'action' => 'edit'),
                )
            ),

            'Reject Partners' => array(
                'order'   => 205,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'reject-partners', 'action' => 'list'),
                )
            ),

            'Dopozyczka Pixels' => array(
                'order'   => 206,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'dopozyczka', 'action' => 'list'),
                )
            ),
        )
    ),

    330 => array(
        'name' => 'Support',
        'url'  => array('module' => 'admin', 'controller' => 'tickets', 'action' => 'index'),

        'items' => array(
            'Tickets'     => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'tickets', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'tickets', 'action' => 'add')
                )
            ),
            'Departments' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'tickets', 'action' => 'list-departments'),
                    array('module' => 'admin', 'controller' => 'tickets', 'action' => 'edit-department'),
                    array('module' => 'admin', 'controller' => 'tickets', 'action' => 'add-department'),
                )
            ),

            'Statuses' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'tickets', 'action' => 'list-statuses'),
                    array('module' => 'admin', 'controller' => 'tickets', 'action' => 'add-status'),
                )
            ),

        )
    ),
    331 => array(
        'name' => 'Payments',
        'url'  => array('module' => 'admin', 'controller' => 'payment', 'action' => 'list'),

        'items' => array(
            'Payments'        => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'payment', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'payment', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'payment', 'action' => 'edit'),
                )
            ),
            'Define payment'  => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'payment', 'action' => 'list-affiliates'),
                    array('module' => 'admin', 'controller' => 'payment', 'action' => 'add-custom'),
                )
            ),
            'Estimated amount of payment'  => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'payment', 'action' => 'expectations'),
                )
            ),
            'Payment methods' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'payment', 'action' => 'list-methods'),
                    array('module' => 'admin', 'controller' => 'payment', 'action' => 'edit-method'),
                    array('module' => 'admin', 'controller' => 'payment', 'action' => 'add-method'),
                )
            ),
        )
    ),

    332 => array(
        'name' => 'Virtual Agent',
        'url'  => array('module' => 'admin', 'controller' => 'virtual-agent', 'action' => 'list'),

        'items' => array(
            'Virtual Agents' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'virtual-agent', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'virtual-agent', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'virtual-agent', 'action' => 'edit'),
                )
            ),
            'Template'       => array(
                'order'   => 2,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'virtual-agent-template', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'virtual-agent-template', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'virtual-agent-template', 'action' => 'edit'),
                )
            ),
            'History'        => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'virtual-agent', 'action' => 'history'),
                )
            ),
        )
    ),

    333 => array(
        'name' => 'Packages',
        'url'  => array('module' => 'admin', 'controller' => 'websites', 'action' => 'list'),

        'items' => array(
            'Websites' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'websites', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'websites', 'action' => 'load-latest'),
                    array('module' => 'admin', 'controller' => 'websites', 'action' => 'load-latest-for-all'),

                )
            ),
            'Packages' => array(
                'order'   => 2,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'packages', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'packages', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'packages', 'action' => 'edit'),
                )
            ),

        ),
    ),
    335 => array(
        'name' => 'WojtekDoradza',
        'url'  => array('module' => 'admin', 'controller' => 'categories', 'action' => 'list'),

        'items' => array(
            'Offers' => array(
                'order'   => 2,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'add-credit'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'add-lend'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'add-business-bank-account'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'add-personal-bank-account'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'add-savings-bank-account'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'add-credit-card'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'add-car-insurance'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'add-life-insurance'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'add-property-insurance'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'add-fast-lend'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'edit-credit'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'edit-lend'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'edit-business-bank-account'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'edit-personal-bank-account'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'edit-savings-bank-account'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'edit-credit-card'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'edit-car-insurance'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'edit-life-insurance'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'edit-property-insurance'),
                    array('module' => 'admin', 'controller' => 'offers', 'action' => 'edit-fast-lend'),
                )
            ),
            'Subcategories' => array(
                'order'   => 1,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'categories', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'categories', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'categories', 'action' => 'edit'),
                    array('module' => 'admin', 'controller' => 'categories', 'action' => 'subcategories'),
                )
            ),
            'Posts' => array(
                'order'   => 3,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'articles', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'articles', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'articles', 'action' => 'edit'),
                )
            ),
            'Companies' => array(
                'order'   => 4,
                'actions' => array(
                    array('module' => 'admin', 'controller' => 'wd-companies', 'action' => 'list'),
                    array('module' => 'admin', 'controller' => 'wd-companies', 'action' => 'add'),
                    array('module' => 'admin', 'controller' => 'wd-companies', 'action' => 'edit'),
                )
            ),
        ),
    ),
);
 
return $menu;

?>