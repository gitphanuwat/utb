<?php
namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;
use App\Amphur;
use App\Organize;
use App\Village;
use App\Repositories\UserRepositorymng;
use App\Repositories\RoleRepositorymng;

use App\Http\Requests\MemberRequest;

use Auth;
class MemberController extends Controller
{
  protected $user_gestion;
	protected $role_gestion;
     public function __construct(UserRepositorymng $user_gestion,RoleRepositorymng $role_gestion)
     {
       //$this->middleware('manager',function(){
       //});
       $this->middleware('organize');

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
  		return view('manager.index', compact('users', 'links', 'counts', 'roles'));
      //return "hessl";
  	}


    public function create()
    {

      $data['method']="POST";
      $data['url']=url('managerset/member/');

      $objsrole = Role::lists('title', 'id');
      $data['objsrole']=$objsrole;

      return view('manager.create',$data);

    }

    public function store(MemberRequest $request)
    {
      try {
      if(Auth::user()->organize_id == $request['organize_id']){
        $obj = new User();
        $obj->role_id = $request['role_id'];
        $obj->amphur_id = $request['amphur_id'];
        $obj->organize_id = $request['organize_id'];
        $obj->village_id = $request['village_id'];
        $obj->headname = $request['headname'];
        $obj->firstname = $request['firstname'];
        $obj->lastname = $request['lastname'];
        $obj->address = $request['address'];
        $obj->tel = $request['tel'];
        $obj->facebook = $request['facebook'];
        $obj->email = $request['email'];
        $obj->password = bcrypt($request['password']);
        $obj->remember_token = $request['_token'];
        $obj->save();
        return redirect('managerset/member?page='.session()->get('page'));
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
      if(Auth::user()->organize_id == $obj->organize_id){
        $data['obj']=$obj;
        return view('manager.show',$data);
      }
      abort(403);
    }


    public function edit($id)
    {
      $obj = User::find($id);
      if(Auth::user()->organize_id == $obj->organize_id){
        $data['url']=url('managerset/member/'.$id);
        $data['method']="PUT";
        $data['obj']=$obj;
        return view('manager.edit',$data);
      }
      abort(403);
    }

    public function update(MemberRequest $request, $id)
    {
      try {
      $obj = User::find($id);
      if(Auth::user()->organize_id == $obj->organize_id){
          $obj->amphur_id = $request['amphur_id'];
          $obj->organize_id = $request['organize_id'];
          $obj->village_id = $request['village_id'];
          $obj->headname = $request['headname'];
          $obj->firstname = $request['firstname'];
          $obj->lastname = $request['lastname'];
          $obj->address = $request['address'];
          $obj->tel = $request['tel'];
          $obj->facebook = $request['facebook'];
          //$obj->picture = $request['picture'];
          $obj->email = $request['email'];
          if($obj->password!=$request['password']){
            $obj->password = bcrypt($request['password']);
          }
          $obj->role_id = $request['role_id'];

          $obj->save();
          return redirect('managerset/member?page='.session()->get('page'));
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
      if(Auth::user()->organize_id == $obj->organize_id){
          $obj->delete();
          return redirect('managerset/member');
      }
      abort(403);
    }
}
