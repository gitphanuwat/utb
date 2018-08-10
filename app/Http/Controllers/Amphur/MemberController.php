<?php
namespace App\Http\Controllers\Univer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;
use App\University;
use App\Center;
use App\Area;
use App\Repositories\UserRepositoryuni;
use App\Repositories\RoleRepositoryuni;

use App\Http\Requests\MemberRequest;

class MemberController extends Controller
{
  protected $user_gestion;
	protected $role_gestion;
     public function __construct(UserRepositoryuni $user_gestion,RoleRepositoryuni $role_gestion)
     {
       $this->middleware('university');

        $this->user_gestion = $user_gestion;
    		$this->role_gestion = $role_gestion;
     }

    public function index()
    {
        return $this->indexSort('total');
    }

    public function indexSort($role)
  	{
      $counts = $this->user_gestion->counts();
  		$users = $this->user_gestion->index(10, $role);
  		$links = $users->render();
  		$roles = $this->role_gestion->all();
  		return view('univer.index', compact('users', 'links', 'counts', 'roles'));
  	}


    public function create()
    {

      $data['method']="POST";
      $data['url']=url('univer/member/');

      $objsrole = Role::lists('title', 'id');
      $data['objsrole']=$objsrole;

      return view('univer.create',$data);

    }

    public function store(MemberRequest $request)
    {
      try {
      if(Auth::user()->university_id == $request['university_id']){
        $obj = new User();
        $obj->role_id = $request['role_id'];
        $obj->university_id = $request['university_id'];
        $obj->center_id = $request['center_id'];
        $obj->area_id = $request['area_id'];
        $obj->headname = $request['headname'];
        $obj->firstname = $request['firstname'];
        $obj->lastname = $request['lastname'];
        $obj->address = $request['address'];
        $obj->tel = $request['tel'];
        $obj->facebook = $request['facebook'];
        $obj->permit = $request['permit'];
        $obj->email = $request['email'];
        $obj->password = bcrypt($request['password']);
        $obj->remember_token = $request['_token'];
        $obj->save();
        return redirect('univer/member?page='.session()->get('page'));
      }
      abort(403);
      } catch(\Illuminate\Database\QueryException $ex){
        if($ex->getCode() === '23000') {
          return view('errors.email');
        }
      }
    }


     public function show($id)
     {
        $obj = User::find($id);
        if(Auth::user()->university_id == $obj->university_id){
          $data['obj']=$obj;
          return view('univer.show',$data);
       }
       abort(403);
     }


    public function edit($id)
    {

      $obj = User::find($id);
      if(Auth::user()->university_id == $obj->university_id){
        $data['url']=url('univer/member/'.$id);
        $data['method']="PUT";
        $data['obj']=$obj;

        return view('univer.edit',$data);
      }
      abort(403);
    }


    public function update(MemberRequest $request, $id)
    {
      try {
      $obj = User::find($id);
      if(Auth::user()->university_id == $obj->university_id){
        //$obj->university_id = $request['university_id'];
        $obj->center_id = $request['center_id'];
        $obj->area_id = $request['area_id'];
        $obj->headname = $request['headname'];
        $obj->firstname = $request['firstname'];
        $obj->lastname = $request['lastname'];
        $obj->address = $request['address'];
        $obj->tel = $request['tel'];
        $obj->facebook = $request['facebook'];
        $obj->permit = $request['permit'];
        $obj->email = $request['email'];
        if($obj->password!=$request['password']){
          $obj->password = bcrypt($request['password']);
        }
        $obj->role_id = $request['role_id'];

        $obj->save();
        return redirect('univer/member?page='.session()->get('page'));
      }
      abort(403);
      } catch(\Illuminate\Database\QueryException $ex){
        if($ex->getCode() === '23000') {
          return view('errors.email');
        }
      }
    }

    public function updateSeen(
   		Request $request,
   		User $user)
   	  {
     		   $this->user_gestion->update($request->all(), $user);
     		   return response()->json();
   	  }

    public function destroy($id)
    {
        $obj = User::find($id);
        if(Auth::user()->university_id == $obj->university_id){
          $obj->delete();
          return redirect('univer/member');
        }
        abort(403);
    }

}
