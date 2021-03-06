<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
| Define the routes for your Frontend pages here
|
*/

Route::get('/', [
    'as' => 'home', 'uses' => 'FrontendController@home'
]);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Route group for Backend prefixed with "admin".
| To Enable Authentication just remove the comment from Admin Middleware
|
*/

Route::group([
    'prefix' => 'admin',
//    'middleware' => 'admin'
], function () {

    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');

    //Install CRUD
    Route::resource('install','InstallController');
    Route::get('data_install','InstallController@list');
    Route::post('data_install_column','InstallController@column');
    Route::get('detailvalue','InstallController@detailvalue');
    Route::post('createmvc','InstallController@createmvc');

    //Example CRUD
    Route::resource('example','ExampleController');
    Route::get('data_example','ExampleController@list');

    // Dashboard
    //----------------------------------

    Route::get('/', [
        'as' => 'admin.dashboard', 'uses' => 'DashboardController@index'
    ]);

    Route::get('/dashboard/basic', [
        'as' => 'admin.dashboard.basic', 'uses' => 'DashboardController@basic'
    ]);

    Route::get('/dashboard/ecommerce', [
        'as' => 'admin.dashboard.ecommerce', 'uses' => 'DashboardController@ecommerce'
    ]);

    Route::get('/dashboard/finance', [
        'as' => 'admin.dashboard.finance', 'uses' => 'DashboardController@finance'
    ]);

    // Layouts
    //----------------------------------

    Route::group(['prefix' => 'layouts'], function () {

        Route::get('sidebar', [
            'as' => 'admin.layouts.sidebar', 'uses' => 'Demo\PagesController@sidebarLayout'
        ]);

        Route::get('icon-sidebar', [
            'as' => 'admin.layouts.icon-sidebar', 'uses' => 'Demo\PagesController@iconSidebar'
        ]);

        Route::get('horizontal-menu', [
            'as' => 'admin.layouts.horizontal', 'uses' => 'Demo\PagesController@horizontalMenu'
        ]);
    });

    // UI Elements
    //----------------------------------

    Route::group(['prefix' => 'basic-ui'], function () {

        Route::get('buttons', [
            'as' => 'admin.ui.buttons', 'uses' => 'Demo\PagesController@buttons'
        ]);

        Route::get('typography', [
            'as' => 'admin.ui.typography', 'uses' => 'Demo\PagesController@typography'
        ]);

        Route::get('tabs', [
            'as' => 'admin.ui.tabs', 'uses' => 'Demo\PagesController@tabs'
        ]);

        Route::get('cards', [
            'as' => 'admin.ui.cards', 'uses' => 'Demo\PagesController@cards'
        ]);

        Route::get('tables', [
            'as' => 'admin.ui.tables', 'uses' => 'Demo\PagesController@tables'
        ]);

        Route::get('modals', [
            'as' => 'admin.ui.modals', 'uses' => 'Demo\PagesController@modals'
        ]);

        Route::get('progress-bars', [
            'as' => 'admin.ui.progress-bars', 'uses' => 'Demo\PagesController@progressBars'
        ]);
    });

    // Components
    //----------------------------------

    Route::group(['prefix' => 'components'], function () {

        Route::get('notifications', [
            'as' => 'admin.components.notifications', 'uses' => 'Demo\PagesController@notifications'
        ]);

        Route::get('datatables', [
            'as' => 'admin.components.datatables', 'uses' => 'Demo\PagesController@datatables'
        ]);

        Route::get('nestable-list', [
            'as'=>'admin.components.nestableList', 'uses'=>'Demo\PagesController@nestableList'
        ]);

        Route::get('nestable-tree', [
            'as'=>'admin.components.nestableTree', 'uses'=>'Demo\PagesController@nestableTree'
        ]);

        Route::get('image-cropper', [
            'as' => 'admin.components.imagecropper', 'uses' => 'Demo\PagesController@imageCropper'
        ]);

        Route::get('zoom', [
            'as' => 'admin.components.zoom', 'uses' => 'Demo\PagesController@imageZoom'
        ]);

        Route::get('calendar', [
            'as' => 'admin.components.calendar', 'uses' => 'Demo\PagesController@calendar'
        ]);

        Route::group(['prefix' => 'ratings'], function () {

            Route::get('star', [
                'as' => 'admin.components.ratings.star', 'uses' => 'Demo\PagesController@ratings'
            ]);

            Route::get('bar', [
                'as' => 'admin.components.rating.bar', 'uses' => 'Demo\PagesController@barRatings'
            ]);
        });

        Route::get('contacts', [
            'as' => 'admin.components.contacts', 'uses' => 'Demo\PagesController@contacts'
        ]);
    });

    // Charts
    //----------------------------------

    Route::group(['prefix' => 'charts'], function () {

        Route::get('chartjs', [
            'as' => 'admin.charts.chartjs', 'uses' => 'Demo\PagesController@chartjs'
        ]);

        Route::get('sparklines', [
            'as' => 'admin.charts.sparklines', 'uses' => 'Demo\PagesController@sparklineCharts'
        ]);

        Route::get('amcharts', [
            'as' => 'admin.charts.amcharts', 'uses' => 'Demo\PagesController@amCharts'
        ]);

        Route::get('morris', [
            'as' => 'admin.charts.morris', 'uses' => 'Demo\PagesController@morrisCharts'
        ]);

        Route::get('gauges', [
            'as' => 'admin.charts.gauges', 'uses' => 'Demo\PagesController@gaugeCharts'
        ]);
    });

    // Form Components
    //----------------------------------

    Route::group(['prefix' => 'forms'], function () {

        Route::get('general', [
            'as' => 'admin.forms.general', 'uses' => 'Demo\PagesController@general'
        ]);

        Route::get('advanced', [
            'as' => 'admin.forms.advanced', 'uses' => 'Demo\PagesController@advanced'
        ]);

        Route::get('layouts', [
            'as' => 'admin.forms.layouts', 'uses' => 'Demo\PagesController@layouts'
        ]);

        Route::get('validation', [
            'as' => 'admin.forms.validation', 'uses' => 'Demo\PagesController@validation'
        ]);

        Route::get('editors', [
            'as' => 'admin.forms.editors', 'uses' => 'Demo\PagesController@editors'
        ]);

        Route::get('wizards', [
            'as' => 'admin.forms.wizards', 'uses' => 'Demo\PagesController@wizards'
        ]);

        Route::get('wizards-2', [
            'as' => 'admin.forms.wizards2', 'uses' => 'Demo\PagesController@wizards2'
        ]);

        Route::get('wizards-3', [
            'as' => 'admin.forms.wizards3', 'uses' => 'Demo\PagesController@wizards3'
        ]);
    });

    // Gallery Components
    //----------------------------------

    Route::group(['prefix' => 'gallery'], function () {

        Route::get('grid', [
            'as' => 'admin.gallery.grid', 'uses' => 'Demo\PagesController@galleryGrid'
        ]);

        Route::get('masonry-grid', [
            'as' => 'admin.gallery.masonry-grid', 'uses' => 'Demo\PagesController@galleryMasonryGrid'
        ]);
    });

    // Login, Register & Maintenance Pages
    //----------------------------------

    Route::get('login-2', [
        'as' => 'admin.login-2', 'uses' => 'Demo\PagesController@login2'
    ]);

    Route::get('login-3', [
        'as' => 'admin.login-3', 'uses' => 'Demo\PagesController@login3'
    ]);

    Route::get('register-2', [
        'as' => 'admin.register-2', 'uses' => 'Demo\PagesController@register2'
    ]);

    Route::get('register-3', [
        'as' => 'admin.register-3', 'uses' => 'Demo\PagesController@register3'
    ]);

    Route::get('maintenance', [
        'as' => 'admin.maintenance', 'uses' => 'Demo\PagesController@maintenance'
    ]);

    // Icon Preview Pages
    //----------------------------------

    Route::group(['prefix' => 'icons'], function () {

        Route::get('/icomoon', [
            'as' => 'admin.icons.icomoon', 'uses' => 'Demo\PagesController@icoMoons'
        ]);

        Route::get('/evil', [
            'as' => 'admin.icons.evil', 'uses' => 'Demo\PagesController@evilIcons'
        ]);

        Route::get('/meteo', [
            'as' => 'admin.icons.meteo', 'uses' => 'Demo\PagesController@meteoIcons'
        ]);

        Route::get('/line', [
            'as' => 'admin.icons.line', 'uses' => 'Demo\PagesController@lineIcons'
        ]);

        Route::get('/fps-line', [
            'as' => 'admin.icons.fpsline', 'uses' => 'Demo\PagesController@fpsLineIcons'
        ]);

        Route::get('/fontawesome', [
            'as' => 'admin.icons.fontawesome', 'uses' => 'Demo\PagesController@fontawesomeIcons'
        ]);
    });

    // Todos
    //----------------------------------

    Route::resource('todos', 'Demo\TodosController');

    Route::post('todos/toggleTodo/{id}', [
        'as' => 'admin.todos.toggle', 'uses' => 'Demo\TodosController@toggleTodo'
    ]);

    Route::resource('users', 'UsersController');

    // Settings
    //----------------------------------

    Route::group(['prefix' => 'settings'], function () {


        Route::get('/social', [
            'as' => 'admin.settings.index', 'uses' => 'SettingsController@index'
        ]);

        Route::post('/social', [
            'as' => 'admin.settings.social', 'uses' => 'SettingsController@postSocial'
        ]);

        Route::group(['prefix' => 'mail'], function () {

            Route::get('/', [
                'as' => 'admin.settings.mail.index', 'uses' => 'SettingsController@mail'
            ]);

            Route::post('/', [
                'as' => 'admin.settings.mail.post', 'uses' => 'SettingsController@postMail'
            ]);

            Route::post('/send-test-email', [
                'as' => 'admin.settings.mail.send', 'uses' => 'SettingsController@sendTestMail'
            ]);
        });
    });
    Route::get('test',function() {
        dd(1);
    });
    Route::group(['prefix' => 'documents'], function() {
        Route::get('generate_no/{type}', 'DocumentController@generate_no');

        Route::get('/quotation/{id?}', 'DocumentController@quotation');
        Route::get('/create_quotation', 'DocumentController@create_quotation');
        Route::post('/create_quotation', 'DocumentController@store_quotation');
        
        Route::get('/invoice/{id?}', 'DocumentController@invoice');
        Route::post('/create_invoice', 'DocumentController@store_invoice');
        Route::get('/create_invoice/{id?}', 'DocumentController@create_invoice');
        
        Route::get('/tax_invoice/{id?}', 'DocumentController@tax_invoice');
        Route::post('/create_tax_invoice', 'DocumentController@store_tax_invoice');
        Route::get('/create_tax_invoice/{id?}', 'DocumentController@create_tax_invoice');
    });
    Route::group(['prefix' => 'manages'], function() 
    {
        # Contact Type
        Route::resource('contact_type','Admin\ContacttypeController');
        Route::get('contact_type_list','Admin\ContacttypeController@list');

        # Menu
        Route::get('main', 'ManageController@main');
        Route::get('main/lists', 'ManageController@main_lists');
        Route::post('main/store', 'ManageController@main_store');
        Route::get('main/{id}', 'ManageController@main_show');
        Route::post('main/{id}', 'ManageController@main_delete');
        # Sub menu
        Route::get('detail', 'ManageController@detail');
        Route::get('detail/lists', 'ManageController@detail_lists');
        Route::post('detail/store', 'ManageController@detail_store');
        Route::get('detail/{id}', 'ManageController@detail_show');
        Route::post('detail/{id}', 'ManageController@detail_delete');
        # Content
        Route::get('content', 'ManageController@content');
        Route::get('content/lists', 'ManageController@content_lists');
        Route::get('content/create', 'ManageController@content_create');
        Route::post('content/store', 'ManageController@content_store');
        Route::get('content/{id}', 'ManageController@content_show');
        Route::post('content/{id}', 'ManageController@content_delete');
        # Contact us
        Route::get('contact-us', 'ManageController@contact_us');
        Route::get('contact-us/lists', 'ManageController@contact_us_lists');
        Route::post('contact-us/store', 'ManageController@contact_us_store');
        Route::get('contact-us/{id}', 'ManageController@contact_us_show');
        Route::post('contact-us/{id}', 'ManageController@contact_us_delete');
        # Category
        Route::get('category', 'ManageController@category');
        Route::get('category/lists', 'ManageController@category_lists');
        Route::post('category/store', 'ManageController@category_store');
        Route::get('category/{id}', 'ManageController@category_show');
        Route::post('category/{id}', 'ManageController@category_delete');
        # Customer
        Route::get('customer', 'ManageController@customer');
        Route::get('customer/lists', 'ManageController@customer_lists');
        Route::post('customer/store', 'ManageController@customer_store');
        Route::get('customer/{id}', 'ManageController@customer_show');
        Route::post('customer/{id}', 'ManageController@customer_delete');

        Route::get('laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
        Route::post('laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    });
});

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
| Guest routes cannot be accessed if the user is already logged in.
| He will be redirected to '/" if he's logged in.
|
*/

Route::group(['middleware' => ['guest']], function () {

    Route::get('login', [
        'as' => 'login', 'uses' => 'AuthController@login'
    ]);

    Route::get('register', [
        'as' => 'register', 'uses' => 'AuthController@register'
    ]);

    Route::post('login', [
        'as' => 'login.post', 'uses' => 'AuthController@postLogin'
    ]);

    Route::get('forgot-password', [
        'as' => 'forgot-password.index', 'uses' => 'ForgotPasswordController@getEmail'
    ]);

    Route::post('/forgot-password', [
        'as' => 'send-reset-link', 'uses' => 'ForgotPasswordController@postEmail'
    ]);

    Route::get('/password/reset/{token}', [
        'as' => 'password.reset', 'uses' => 'ForgotPasswordController@GetReset'
    ]);

    Route::post('/password/reset', [
        'as' => 'reset.password.post', 'uses' => 'ForgotPasswordController@postReset'
    ]);

    Route::get('auth/{provider}', 'AuthController@redirectToProvider');

    Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');
});

Route::get('logout', [
    'as' => 'logout', 'uses' => 'AuthController@logout'
]);

Route::get('install', [
    'as' => 'logout', 'uses' => 'AuthController@logout'
]);