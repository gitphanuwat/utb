<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\QuestRequest;
use Mail;
use App\Question;
use App\Http\Requests;
use Validator;

class MailController extends Controller {

  public function sendmail4(Request $request)
  {
    $data='';
    $datas=$request['check_users'];
    //foreach ($datas as $key => $value) {
      //$data .= $value;
    //}
    return $datas;
  }
  public function sendmail_teste(Request $request){
    //return 0;
  }
  public function sendmail(QuestRequest $request){
     $data = array(
       'sender'=>$request['sender'],
       'address'=>$request['address'],
       'email'=>$request['email'],
       'tel'=>$request['tel'],
       'topic'=>$request['topic'],
       'detail'=>$request['detail'],
       'check_users'=>$request['check_users'],
     );
    Mail::send('sendmail', $data, function($message) use ($data) {
        $message->from('thelrdsystem@gmail.com','LRD System');
        $message->to($data['email'],$data['sender']);
        $message->subject($data['topic']);

        foreach ($data['check_users'] as $key => $value) {
          $user = explode(",", $value);
          $validator = Validator::make(
            ['email' => $user[0]],
            ['email' => 'required|email']
          );
          if(!$validator->fails()){
            $message->cc($user[0], $user[1]);
            $check=1;
          }
        }
     });
     if(Mail::failures()){
       return 2;
     }else{
       return 1;
     }
  }

    public function html_email(){
       $data = array('name'=>'สมศักดิ์','topic'=>'ใจดี','question'=>'คำถามปัญหาชุมชน');
       //$data = array('name'=>$sender,'topic'=>$topic,'question'=>$question);

       Mail::send('mail', $data, function($message) {
          $message->to('mr.phanuwat@gmail.com', 'สมาชิกระบบ')->subject
             ('LRD Systems Message');
          $message->from('thelrdsystem@gmail.com','LRD System');
       });
       echo "HTML Email Sent. Check your inbox.";
    }

   public function basic_email(){
      $data = array('name'=>"Virat Gandhi");
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('mr.phanuwat@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      return 0;
      //if($check>0){return 0;}else{return 1;}
      //echo "Basic Email Sent. Check your inbox.";
   }

   public function attachment_email(){
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('images\no_image.png');
         $message->attach('images\lrd_logo.PNG');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}
