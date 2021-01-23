<?php
// Prueba de belongstoMany de visit to Stepstofollow
// Route::get('/step_to_follows_of_visit', function(){

//         $visit = App\Http\Models\Visit::with('stepstofollows')->get();
//                   return $visit;
// });

// Route::get('/export', 'VisitController@export')->name('export');
// Route::get('/export', 'VisitController@export')->name('export');
// // Route::get('/updatecommentcancell', 'VisitController@updatecommentcancell')->name('updatecommentcancell');
// Route::put('/updatecommentcancell', 'VisitController@updatecommentcancell')->name('updatecommentcancell');
// Route::get('/getUser', 'Administrador\UsersController@getUser')->name('getUser');
// Route::get('/listAndFilterUsers/{busqueda}', 'Administrador\UsersController@listAndFilterUsers')->name('listAndFilterUsers');
// // Route::get('/usuarioid/{id}', 'VisitController@usuarioid')->name('usuarioid');


// Route::get('/recommendation', function () {
//     return view('recommendation');

// });
// Route::get('/visitas', function () {
//     return view('visitas');
// });



// Export Excel Example Uer
// Route::get('importExportView', 'MyController@importExportView');
// Route::get('/export', 'MyController@export')->name('export');
// Route::post('/import', 'MyController@import')->name('import');

// Export Excel Example Contacs
// Route::get('/exportexcelcontact', 'ContactController@exportexcel')->name('exportexcelcontact');

//           //Export PDF Visit
//  Route::get('/export_pdf_visit/{user_id}', 'VisitController@exportpdf')->name('export_pdf_visit');
//  Route::get('/export_pdf_visit2/{user_id}', 'VisitController@exportpdf2')->name('export_pdf_visit2');


// // Export Excel Visit
// Route::get('/export_excel_visit/{user_id}', 'VisitController@exportexcel')->name('exportexcel');
// Route::get('/export_excel_visit2/{user_id}', 'VisitController@exportexcel2')->name('exportexcel2');
// Route::get('/bladeToExcel', 'ExcelController@bladeToExcel')->name('bladeToExcel');
// // Route::get('exportexcelview', 'VisitController@exportexcelview')->name('exportexcelview');

// //Export PDF Meeting
// Route::get('/export_pdf_meeting/{user_id}', 'MeetingController@exportpdf')->name('export_pdf_meeting');
// // Export Excel Meeting
// Route::get('/exportexcelmeeting/{user_id}', 'MeetingController@exportexcel')->name('exportexcelmeeting');

// //Export PDF Mechanism
// Route::get('/export_pdf_mechanism/{user_id}', 'MechanismController@exportpdf')->name('export_pdf_mechanism');
// // Export Excel Mechanism
// Route::get('/exportexcelmechanism/{user_id}', 'MechanismController@exportexcel')->name('exportexcelmechanism');

// // Export Excel Activity
// Route::get('/exportexcelactivity/{user_id}', 'ActivityController@exportexcel')->name('exportexcelactivity');
// Route::get('/export_pdf_activity/{user_id}', 'ActivityController@exportpdf')->name('export_pdf_activity');

// // Export Excel Activity
// Route::get('/export_excel_oportunity/{user_id}', 'OportunityController@exportexcel')->name('export_excel_oportunity');
// Route::get('/export_pdf_oportunity/{user_id}', 'OportunityController@exportpdf')->name('export_pdf_oportunity');

// // Export Excel n PDF Collaboration
// Route::get('/exportexcelcollaboration/{user_id}', 'CollaborationController@exportexcel')->name('exportexcelcollaboration');
// Route::get('/export_pdf_collaboration/{user_id}', 'CollaborationController@exportpdf')->name('export_pdf_collaboration');

// // Export Excel n PDF Collaboration
// Route::get('/exportexceltender/{user_id}', 'TenderController@exportexcel')->name('exportexceltender');
// Route::get('/export_pdf_tender/{user_id}', 'TenderController@exportpdf')->name('export_pdf_tender');

// // Export Excel n PDF Event
// Route::get('/exportexcelevent/{user_id}', 'EventController@exportexcel')->name('exportexcelevent');
// Route::get('/export_pdf_event/{user_id}', 'EventController@exportpdf')->name('export_pdf_event');

Route::any('{path?}', function () {
    return view("app");
})->where("path", ".+");
