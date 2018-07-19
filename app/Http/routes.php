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
  Route::resource('managerset/organize','Manager\OrganizeController');
  Route::resource('managerset/person','Manager\PersonController');
  Route::post('managerset/personpost/{id}','Manager\PersonController@personupdate');
  Route::put('managerset/organize/updatevision/{id}','Manager\OrganizeController@updatevision');
  Route::resource('managerset/village','Manager\VillageController');
  Route::resource('managerset/group','Manager\GroupController');
  Route::resource('managerset/activity','Manager\ActivityController');
  Route::resource('managerset/tourist','Manager\TouristController');

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
// Operator village
Route::group(['middleware' => 'operator'], function () {
  Route::resource('operatorset/member','Operator\MemberController');
  Route::get('operatorset/member/sort/{role}', 'Operator\MemberController@indexSort');
  Route::put('operatorset/member/userseen/{user}', 'Operator\MemberController@updateSeen');
  Route::resource('operator/expert','ExpertController');
  Route::resource('operator/villageuser','Operator\VillageUserController');
  Route::resource('operator/problem','Operator\ProblemController');
  Route::post('operator/uploadfile','Operator\VillageUserController@uploadFile');

});
// All village For Auth
Route::group(['middleware' => 'auth'], function () {

  Route::post('user/upload', ['as' => 'upload-post', 'uses' =>'ImageController@postUpload']);
  Route::post('user/upload/delete', ['as' => 'upload-remove', 'uses' =>'ImageController@deleteUpload']);
  Route::get('user/server-images/{file_id}', ['as' => 'server-images', 'uses' => 'ImageController@getServerImages']);
  Route::resource('user/useful','UsefulController');
  Route::resource('user/question','QuestionController');
  Route::post('user/question/getresearcher','QuestionController@getresearcher');
  Route::resource('user/infor','InforController');
  Route::resource('user/creative','CreativeController');
  Route::resource('user/file','FileController');
  //Route::post('user/villagefile','FileController@villageFile');
  //Route::post('user/villagefile', ['as' => 'villagefile', 'uses' =>'FileController@villageFile']);

  Route::resource('user/research','ResearchController');
  Route::resource('user/expert','ExpertController');
  Route::resource('user/villageuser','VillageUserController');
  Route::post('user/uploadfile','VillageUserController@uploadFile');

  Route::resource('user/problem','ProblemController');
  Route::resource('user/expertlist','ExpertlistController');
  Route::resource('user/researcher','ResearcherController');
  Route::get('user/tagdetail','ExpertlistController@tagdetail');
  Route::resource('user/article','ArticlesController');
  Route::get('profile/show','ProfileController@show');
  Route::get('profile/edit','ProfileController@edit');
  Route::get('profile/delpicture/{id}','ProfileController@delPicture');
  Route::post('profile/savepicture','ProfileController@savePicture');
  Route::put('profile/change','ProfileController@putEdit');
  Route::put('profile/changepass','ProfileController@putChangePassword');

  Route::get('analyze/struct','AnalyzeController@struct');
  Route::get('analyze/getcenter','AnalyzeController@getcenter');
  Route::get('analyze/getvillage','AnalyzeController@getvillage');

  Route::get('analyze/recheck','AnalyzeController@recheck');
  Route::get('analyze/getexp','AnalyzeController@getexp');
  Route::get('analyze/getrech','AnalyzeController@getrech');
  Route::get('analyze/getres','AnalyzeController@getres');
  Route::get('analyze/getcre','AnalyzeController@getcre');
  Route::get('analyze/getare','AnalyzeController@getare');
  Route::get('analyze/getpro','AnalyzeController@getpro');

  Route::get('analyze/userlog','AnalyzeController@userlog');
  Route::get('analyze/getLatest','AnalyzeController@getLatest');
  Route::get('analyze/getuserlog','AnalyzeController@getuserlog');

  Route::resource('about/update','UpdateController');

});


Route::get('file/get/{filename}', [
	'as' => 'getfile', 'uses' => 'FileController@get']);
Route::get('file/getload/{filename}', [
  'as' => 'getfileload', 'uses' => 'FileController@getload']);

// Guest village
Route::get('about/system', function () {
    return view('about.system');
});
Route::get('about/project', function () {
    return view('about.project');
});
Route::get('about/as', function () {
    return view('about.as');
});

Route::get('about/updatelast','UpdateController@updatelast');

Route::get('about/updateshow', function () {
    return view('about.update');
    //return "hello";
});


Route::get('report/researcher','ReportController@getResearcher');
Route::get('report/loadresearcher','ReportController@loadResearcher');
Route::get('report/expert','ReportController@getExpert');
Route::get('report/loadexpert','ReportController@loadExpert');
Route::get('report/research','ReportController@getResearch');
Route::get('report/loadresearch','ReportController@loadResearch');
Route::get('report/creative','ReportController@getCreative');
Route::get('report/loadcreative','ReportController@loadCreative');
Route::get('report/village','ReportController@getVillage');
Route::get('report/loadvillage','ReportController@loadVillage');
Route::get('report/problem','ReportController@getProblem');
Route::get('report/loadproblem','ReportController@loadProblem');

Route::get('eis/profile','EisprofileController@showProfile');
Route::get('eis/profileexp','EisprofileController@showProfileexp');
Route::get('eis/profilecreative','EisprofileController@showProfilecreative');
Route::get('eis/profileresearch','EisprofileController@showProfileresearch');
Route::get('eis/profilevillage','EisprofileController@showProfilevillage');
Route::get('eis/profileuseful','EisprofileController@showProfileuseful');
Route::get('eis/profilepro','EisprofileController@showProfilepro');

Route::get('eis/researcher','EisresearcherController@getResearcher');
Route::get('eis/researcher/showexpert','EisresearcherController@showExpert');
Route::get('eis/researcher/showresearch','EisresearcherController@showResearch');
Route::get('eis/researcher/showcreative','EisresearcherController@showCreative');
Route::get('eis/researcher/showgroup','EisresearcherController@showGroup');
Route::get('eis/researcher/showresearcher','EisresearcherController@showResearcher');
Route::get('eis/researcher/name/{id}','EisresearcherController@researchername');

Route::get('eis/expert','EisexpertController@getExpert');
Route::get('eis/expert/showexpertor','EisexpertController@showExpertor');
Route::get('eis/expert/showexpertlist','EisexpertController@showExpertlist');
Route::get('eis/expert/showgroupexp','EisexpertController@showGroupexp');
Route::get('eis/expert/name/{id}','EisexpertController@expertname');

Route::get('eis/research','EisresearchController@getResearch');
Route::get('eis/research/showresearch','EisresearchController@showResearch');
Route::get('eis/research/showgroup','EisresearchController@showGroup');
Route::get('eis/research/showdoc','EisresearchController@showDoc');

Route::get('eis/creative','EiscreativeController@getCreative');
Route::get('eis/creative/showcreative','EiscreativeController@showCreative');
Route::get('eis/creative/showgroup','EiscreativeController@showGroup');

Route::get('eis/village','EisvillageController@getVillage');
Route::get('eis/village/showexp','EisvillageController@showExpert');
Route::get('eis/village/showpro','EisvillageController@showProblem');
Route::get('eis/village/showgroup','EisvillageController@showGroup');
Route::get('eis/village/showvillage','EisvillageController@showVillage');

Route::get('eis/problem','EisproblemController@getProblem');
Route::get('eis/problem/showexp','EisproblemController@showExpert');
Route::get('eis/problem/showpro','EisproblemController@showProblem');
Route::get('eis/problem/showgroup','EisproblemController@showGroup');
Route::get('eis/problem/showproblem','EisproblemController@showProblem');

Route::get('dss/useful','DssusefulController@getUseful');
Route::get('dss/useful/showgraphall','DssusefulController@getGraphall');
Route::get('dss/useful/showgraphuni','DssusefulController@getGraphuni');

Route::get('dss/system','DsssystemController@getSystem');
Route::get('dss/system/showresch','DsssystemController@showResch');
Route::get('dss/system/showexp','DsssystemController@showExp');
Route::get('dss/system/showres','DsssystemController@showRes');
Route::get('dss/system/showcre','DsssystemController@showCre');
Route::get('dss/system/showare','DsssystemController@showAre');
Route::get('dss/system/showpro','DsssystemController@showPro');
Route::get('dss/system/showgroup','DsssystemController@showGroup');
Route::get('dss/system/listresch','DsssystemController@listResch');
Route::get('dss/system/listexp','DsssystemController@listExp');
Route::get('dss/system/listres','DsssystemController@listRes');
Route::get('dss/system/listcre','DsssystemController@listCre');
Route::get('dss/system/listare','DsssystemController@listAre');
Route::get('dss/system/listpro','DsssystemController@listPro');


Route::get('dss/topic','DsstopicController@getTopic');
Route::post('dss/topic','DsstopicController@postTopic');
Route::get('dss/topic/showresch','DsstopicController@showResch');
Route::get('dss/topic/showexp','DsstopicController@showExp');
Route::get('dss/topic/showres','DsstopicController@showRes');
Route::get('dss/topic/showcre','DsstopicController@showCre');
Route::get('dss/topic/showare','DsstopicController@showAre');
Route::get('dss/topic/showpro','DsstopicController@showPro');

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
Route::get('/maps', 'HomeController@maps');
Route::get('/counterhit', 'HomeController@counterhit');
Route::get('/stat', 'HomeController@stat');
Route::get('/loadstat', 'HomeController@loadstat');
//Route::get('/counterread', 'HomeController@counterread');

Route::get('infor','GuestController@getInfor');
Route::get('user/inforshow/{id}','InforController@inforshow');

Route::get('search','GuestController@search');
Route::get('search','GuestController@getSearch');
Route::post('search','GuestController@postSearch');

Route::get('question','GuestController@question');
Route::get('question/showresearcher','GuestController@showresearcher');
Route::post('question/sendquest','GuestController@sendquest');

Route::auth();

Route::post('sendmail','MailController@sendmail');

// For Test
Route::get('/testvillagefile', 'TestController@villagefile');
Route::get('/test', 'TestController@index');
Route::post('test/sendmail','TestController@sendmail');

Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');

//for uttaraditbook.com
Route::get('public/organize','PublicController@organize');
Route::get('public/community','PublicController@community');
Route::get('activity','PublicController@activity');
Route::get('group','PublicController@group');
Route::get('knowledge','PublicController@knowledge');
Route::get('travel','PublicController@travel');
Route::get('calendar','PublicController@calendar');
Route::get('poll','PublicController@poll');
Route::get('complaint','PublicController@complaint');
Route::get('problem','PublicController@problem');
Route::get('download','PublicController@download');
Route::get('about','PublicController@about');
//Route::get('search','PublicController@search');


Route::get('gmaps', 'HomeController@gmaps');
Route::get('gmaps1', 'HomeController@gmaps1');
Route::get('gmaps2', 'HomeController@gmaps2');
Route::get('gmaps5', 'HomeController@gmaps5');
