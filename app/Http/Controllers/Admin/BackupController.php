<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use App\ZipArchive;


class BackupController extends Controller
{
     public function __construct()
     {
         $this->middleware('admin');
     }

     public function backupfile()
     {
         return view('admin.backupfile');
     }



     public function backupfilenow()
     {
       date_default_timezone_set('Asia/Bangkok');
       function human_filesize($bytes, $decimals = 2) {
         $sz = 'BKMGTP';
         $factor = floor((strlen($bytes) - 1) / 3);
         return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$sz[$factor];
       }
       Function listdir($start_dir='.') {
         $files = array();
         if (is_dir($start_dir)) {
           $fh = opendir($start_dir);
           while (($file = readdir($fh)) !== false) {
             # loop through the files, skipping . and .., and recursing if necessary
             if (strcmp($file, '.')==0 || strcmp($file, '..')==0 || strcmp($file, '.DS_Store')==0 || strcmp($file, 'backupfile')==0) continue;
             $filepath = $start_dir . '/' . $file;
             if ( is_dir($filepath) )
               $files = array_merge($files, listdir($filepath));
             else
               array_push($files, $filepath);
           }
           closedir($fh);
         } else {
           # false if the function was called with an invalid non-directory argument
           $files = false;
         }
         return $files;
       }
       $zipA = new ZipArchive();
       $dir    = '.';
       $files1 = listdir($dir);
       date_default_timezone_set('Asia/Bangkok');
       $today = date("Y-m-d_Hisa");
       $filename = "backupfile/Site-Backup_".$today.".zip";

       if ($zipA->open($filename,ZIPARCHIVE::CREATE)!==TRUE) {
           exit("cannot open <$filename>\n");
       }

       for ($i = 0; $i<sizeof($files1); $i++){
       	$zipA->addFile($files1[$i],substr($files1[$i],2));
       }
       $zipA->close();
       $size = human_filesize(filesize($filename))."B";
       return view('admin.backupfile');
     }


     public function backupdb()
     {
       return view('admin.backupdb');
     }
     public function backupdbnow()
     {
       return view('admin.backup_db');
     }

     public function deletefile(Request $request)
     {
       if (isset($request['delete'])){
        for($i=0;$i<count($request['check_files']);$i++)
        {
           if (file_exists($request['check_files'][$i]))
           {
    		   unlink($request['check_files'][$i]);
           }
        }
      return view('admin.backupfile');
      }
     }
     public function deletedb(Request $request)
     {
       if (isset($request['delete'])){
        for($i=0;$i<count($request['check_files']);$i++)
        {
           if (file_exists($request['check_files'][$i]))
           {
    		   unlink($request['check_files'][$i]);
           }
        }
      return view('admin.backupdb');
      }
     }
}
