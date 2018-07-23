<?php
//Finish
// Admin village
Route::group(['middleware' => 'admin'], function () {
    Route::resource('admin/group','Admin\GroupController');
    Route::resource('admin/amphur','Admin\AmphurController');
    Route::resource('admin/organize','Admin\OrganizeController');
    Route::resource('admin/village','Admin\VillageController');
    Route::resource('admin/member','Admin\MemberController');
    Route::post('admin/member/edit', 'Admin\MemberController@edit');
    Route::get('admin/member/sort/{role}', 'Admin\MemberController@indexSort');
    Route::put('admin/member/userseen/{user}', 'Admin\MemberController@updateSeen');
    Route::get('admin/sumpass', 'Admin\MemberController@sumpass');

    Route::get('mnt/bkfile','Admin\BackupController@backupfile');
    Route::get('mnt/bkfilenow','Admin\BackupController@backupfilenow');
    Route::get('mnt/bkdb','Admin\BackupController@backupdb');
    Route::get('mnt/bkdbnow','Admin\BackupController@backupdbnow');
    Route::post('mnt/deletefile','Admin\BackupController@deletefile');
    Route::post('mnt/deletedb','Admin\BackupController@deletedb');
    //Route::get('backupfile/{filename}','Admin\BackupController@get');
    Route::get('analyze/deletestat','AnalyzeController@deletestat');

  });
// amphur village
Route::group(['middleware' => 'amphur'], function () {
    //Route::resource('amphur/village','Amphur\VillageController');
    //Route::resource('amphur/organize','amphur\OrganizeController');
    //Route::resource('amphur/member','Amphur\MemberController');
    //Route::get('amphur/member/sort/{role}', 'Amphur\MemberController@indexSort');
    //Route::put('amphur/member/userseen/{user}', 'Amphur\MemberController@updateSeen');
});
// Manager village
Route::group(['middleware' => 'organize'], function () {
  Route::resource('managerset/social','Manager\SocialController');
  Route::resource('managerset/organize','Manager\OrganizeController');
  Route::resource('managerset/person','Manager\PersonController');
  Route::post('managerset/personpost/{id}','Manager\PersonController@personupdate');
  Route::put('managerset/organize/updatevision/{id}','Manager\OrganizeController@updatevision');
  Route::resource('managerset/village','Manager\VillageController');
  Route::resource('managerset/group','Manager\GroupController');
  Route::resource('managerset/activity','Manager\ActivityController');

  Route::resource('managerset/tourist','Manager\TouristController');
  Route::post('managerset/touristpost/{id}','Manager\TouristController@touristupdate');
  //Route::post('managerset/tpost/{id}','Manager\TouristController@touristupdate');

  Route::resource('managerset/event','Manager\EventController');
  Route::post('managerset/eventpost/{id}','Manager\EventController@eventupdate');

  Route::resource('managerset/problem','Manager\ProblemController');


  Route::resource('managerset/info','Manager\InfoController');
  Route::post('managerset/infopost/{id}','Manager\InfoController@infoupdate');

  Route::resource('managerset/polltopic','Manager\PolltopicController');
  Route::resource('managerset/pollanswer','Manager\PollanswerController');


  Route::resource('managerset/complaint','Manager\ComplaintController');

  Route::resource('managerset/download','Manager\DownloadController');
  Route::post('managerset/downloadpost/{id}','Manager\DownloadController@downloadupdate');

  Route::resource('managerset/member','Manager\MemberController');
  Route::get('manager/memberset/sort/{role}', 'Manager\MemberController@indexSort');
  Route::put('manager/memberset/userseen/{user}', 'Manager\MemberController@updateSeen');
  Route::resource('manager/expert','ExpertController');
  Route::resource('manager/villageuser','Manager\VillageUserController');
  Route::resource('manager/problem','Manager\ProblemController');
  Route::post('manager/uploadfile','Manager\VillageUserController@uploadFile');
});


Route::get('ajax/problem/{id}',array('as'=>'ajax','uses'=>'AjaxController@loadproblem'));
Route::get('ajax/{id}',array('as'=>'ajax','uses'=>'AjaxController@loadorganizeselect'));
Route::get('ajax/{name}/{value}',array('as'=>'ajax','uses'=>'AjaxController@createsession'));

Route::post('ajaxroleall',array('as'=>'ajaxrole','uses'=>'AjaxController@loadroleall'));
Route::get('ajaxrole/{id}',array('as'=>'ajaxrole','uses'=>'AjaxController@loadrole'));
Route::get('ajaxroleuni/{id}',array('as'=>'ajaxrole','uses'=>'AjaxController@loadroleuni'));
Route::get('ajaxrolemng/{id}',array('as'=>'ajaxrole','uses'=>'AjaxController@loadrolemng'));
Route::get('ajaxvillage/{id}',array('as'=>'ajaxvillage','uses'=>'AjaxController@loadvillage'));
Route::get('ajaxvillage_uni/{id}',array('as'=>'ajaxvillage_uni','uses'=>'AjaxController@loadvillage_uni'));
Route::get('ajaxcallcenter/{id}',array('as'=>'ajaxvillagecallcenter','uses'=>'AjaxController@callcenter'));
Route::get('ajaxresch/{id}',array('as'=>'ajaxvillage','uses'=>'AjaxController@loadresch'));
Route::get('ajaxmap', 'AjaxController@loadmap');

Route::get('/', 'HomeController@index');
//Route::get('/{name}', 'HomeController@organize');
Route::get('/counterhit', 'HomeController@counterhit');
Route::get('/stat', 'HomeController@stat');
Route::get('/loadstat', 'HomeController@loadstat');
//Route::get('/counterread', 'HomeController@counterread');

Route::auth();

Route::post('sendmail','MailController@sendmail');

// For Test
