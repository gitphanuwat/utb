<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//use Illuminate\Database;
use App\Http\Requests;
use App\User;
use App\Role;
use App\Amphur;
use App\Organize;
use App\Village;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;

use App\Http\Requests\MemberRequest;
use Auth;

class MemberController extends Controller
{

  protected $user_gestion;
	protected $role_gestion;
     public function __construct(UserRepository $user_gestion,RoleRepository $role_gestion)
     {
       $this->middleware('admin');
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
  		return view('admin.index', compact('users', 'links', 'counts', 'roles'));
      //return "hessl";
  	}


    public function create()
    {

      $data['method']="POST";
      $data['url']=url('admin/member/');
      $objsrole = Role::lists('title', 'id');
      $data['objsrole']=$objsrole;

      return view('admin.create',$data);

    }

    public function store(MemberRequest $request)
    {
      try {
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

        return redirect('admin/member?page='.session()->get('page'));
      } catch(\Illuminate\Database\QueryException $ex){
        if($ex->getCode() === '23000') {
          return view('errors.email');
        }
      }
    }

    public function show($id)
    {
      $obj = User::find($id);
      $data['obj']=$obj;
      return view('admin.show',$data);
    }

    public function edit($id)
    {
      $obj = User::find($id);
      $data['obj']=$obj;
      $objrole = Amphur::lists('name','id');
      $data['objuni']=$objrole;
        $objsrole = Role::lists('title', 'id');
        $data['objsrole']=$objsrole;
        return view('admin.edit',$data);
    }

    public function update(MemberRequest $request, $id)
    {
      try {
          $obj = User::findOrFail($id);
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
          $obj->permit = $request['permit'];
          //$obj->picture = $request['picture'];
          $obj->email = $request['email'];
          if($obj->password!=$request['password']){
            $obj->password = bcrypt($request['password']);
          }
          $obj->save();
          return redirect('admin/member?page='.session()->get('page'));
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
      $obj->delete();
      return redirect('admin/member');
    }

    public function sumpass()
    {
      $obj = User::all();
      return view('admin.sumpass',compact('obj'));
    }
}
