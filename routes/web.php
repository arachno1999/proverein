<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Organe
    Route::delete('organes/destroy', 'OrganeController@massDestroy')->name('organes.massDestroy');
    Route::resource('organes', 'OrganeController');

    // Satzung
    Route::delete('satzungs/destroy', 'SatzungController@massDestroy')->name('satzungs.massDestroy');
    Route::post('satzungs/media', 'SatzungController@storeMedia')->name('satzungs.storeMedia');
    Route::post('satzungs/ckmedia', 'SatzungController@storeCKEditorImages')->name('satzungs.storeCKEditorImages');
    Route::resource('satzungs', 'SatzungController');

    // Finanzen
    Route::delete('finanzens/destroy', 'FinanzenController@massDestroy')->name('finanzens.massDestroy');
    Route::resource('finanzens', 'FinanzenController');

    // Finanzkategorien
    Route::delete('finanzkategoriens/destroy', 'FinanzkategorienController@massDestroy')->name('finanzkategoriens.massDestroy');
    Route::resource('finanzkategoriens', 'FinanzkategorienController');

    // Veranstaltung
    Route::delete('veranstaltungs/destroy', 'VeranstaltungController@massDestroy')->name('veranstaltungs.massDestroy');
    Route::post('veranstaltungs/media', 'VeranstaltungController@storeMedia')->name('veranstaltungs.storeMedia');
    Route::post('veranstaltungs/ckmedia', 'VeranstaltungController@storeCKEditorImages')->name('veranstaltungs.storeCKEditorImages');
    Route::resource('veranstaltungs', 'VeranstaltungController');

    // Mitglieds Typ
    Route::delete('mitglieds-typs/destroy', 'MitgliedsTypController@massDestroy')->name('mitglieds-typs.massDestroy');
    Route::post('mitglieds-typs/media', 'MitgliedsTypController@storeMedia')->name('mitglieds-typs.storeMedia');
    Route::post('mitglieds-typs/ckmedia', 'MitgliedsTypController@storeCKEditorImages')->name('mitglieds-typs.storeCKEditorImages');
    Route::resource('mitglieds-typs', 'MitgliedsTypController');

    // Mitglied
    Route::delete('mitglieds/destroy', 'MitgliedController@massDestroy')->name('mitglieds.massDestroy');
    Route::post('mitglieds/media', 'MitgliedController@storeMedia')->name('mitglieds.storeMedia');
    Route::post('mitglieds/ckmedia', 'MitgliedController@storeCKEditorImages')->name('mitglieds.storeCKEditorImages');
    Route::resource('mitglieds', 'MitgliedController');

    // Verein
    Route::delete('vereins/destroy', 'VereinController@massDestroy')->name('vereins.massDestroy');
    Route::post('vereins/media', 'VereinController@storeMedia')->name('vereins.storeMedia');
    Route::post('vereins/ckmedia', 'VereinController@storeCKEditorImages')->name('vereins.storeCKEditorImages');
    Route::resource('vereins', 'VereinController');

    // Aktion
    Route::delete('aktions/destroy', 'AktionController@massDestroy')->name('aktions.massDestroy');
    Route::post('aktions/media', 'AktionController@storeMedia')->name('aktions.storeMedia');
    Route::post('aktions/ckmedia', 'AktionController@storeCKEditorImages')->name('aktions.storeCKEditorImages');
    Route::resource('aktions', 'AktionController');

    // Ort
    Route::delete('orts/destroy', 'OrtController@massDestroy')->name('orts.massDestroy');
    Route::post('orts/media', 'OrtController@storeMedia')->name('orts.storeMedia');
    Route::post('orts/ckmedia', 'OrtController@storeCKEditorImages')->name('orts.storeCKEditorImages');
    Route::resource('orts', 'OrtController');

    // Tag
    Route::delete('tags/destroy', 'TagController@massDestroy')->name('tags.massDestroy');
    Route::post('tags/media', 'TagController@storeMedia')->name('tags.storeMedia');
    Route::post('tags/ckmedia', 'TagController@storeCKEditorImages')->name('tags.storeCKEditorImages');
    Route::resource('tags', 'TagController');

    // Texte
    Route::delete('textes/destroy', 'TexteController@massDestroy')->name('textes.massDestroy');
    Route::post('textes/media', 'TexteController@storeMedia')->name('textes.storeMedia');
    Route::post('textes/ckmedia', 'TexteController@storeCKEditorImages')->name('textes.storeCKEditorImages');
    Route::resource('textes', 'TexteController');

    // Template
    Route::delete('templates/destroy', 'TemplateController@massDestroy')->name('templates.massDestroy');
    Route::resource('templates', 'TemplateController');

    // Webmenu
    Route::delete('webmenus/destroy', 'WebmenuController@massDestroy')->name('webmenus.massDestroy');
    Route::post('webmenus/media', 'WebmenuController@storeMedia')->name('webmenus.storeMedia');
    Route::post('webmenus/ckmedia', 'WebmenuController@storeCKEditorImages')->name('webmenus.storeCKEditorImages');
    Route::resource('webmenus', 'WebmenuController');

    // Artikel
    Route::delete('artikels/destroy', 'ArtikelController@massDestroy')->name('artikels.massDestroy');
    Route::post('artikels/media', 'ArtikelController@storeMedia')->name('artikels.storeMedia');
    Route::post('artikels/ckmedia', 'ArtikelController@storeCKEditorImages')->name('artikels.storeCKEditorImages');
    Route::resource('artikels', 'ArtikelController');

    // Submenu
    Route::delete('submenus/destroy', 'SubmenuController@massDestroy')->name('submenus.massDestroy');
    Route::post('submenus/media', 'SubmenuController@storeMedia')->name('submenus.storeMedia');
    Route::post('submenus/ckmedia', 'SubmenuController@storeCKEditorImages')->name('submenus.storeCKEditorImages');
    Route::resource('submenus', 'SubmenuController');

    // Howto
    Route::delete('howtos/destroy', 'HowtoController@massDestroy')->name('howtos.massDestroy');
    Route::post('howtos/media', 'HowtoController@storeMedia')->name('howtos.storeMedia');
    Route::post('howtos/ckmedia', 'HowtoController@storeCKEditorImages')->name('howtos.storeCKEditorImages');
    Route::resource('howtos', 'HowtoController');

    // Faq
    Route::delete('faqs/destroy', 'FaqController@massDestroy')->name('faqs.massDestroy');
    Route::post('faqs/media', 'FaqController@storeMedia')->name('faqs.storeMedia');
    Route::post('faqs/ckmedia', 'FaqController@storeCKEditorImages')->name('faqs.storeCKEditorImages');
    Route::resource('faqs', 'FaqController');

    // Howto Nc
    Route::delete('howto-ncs/destroy', 'HowtoNcController@massDestroy')->name('howto-ncs.massDestroy');
    Route::resource('howto-ncs', 'HowtoNcController');

    // Faq Nc
    Route::delete('faq-ncs/destroy', 'FaqNcController@massDestroy')->name('faq-ncs.massDestroy');
    Route::resource('faq-ncs', 'FaqNcController');

    // Verein Single
    Route::delete('verein-singles/destroy', 'VereinSingleController@massDestroy')->name('verein-singles.massDestroy');
    Route::resource('verein-singles', 'VereinSingleController');

    // Counter
    Route::delete('counters/destroy', 'CounterController@massDestroy')->name('counters.massDestroy');
    Route::resource('counters', 'CounterController');

    // Image
    Route::delete('images/destroy', 'ImageController@massDestroy')->name('images.massDestroy');
    Route::post('images/media', 'ImageController@storeMedia')->name('images.storeMedia');
    Route::post('images/ckmedia', 'ImageController@storeCKEditorImages')->name('images.storeCKEditorImages');
    Route::resource('images', 'ImageController');

    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
