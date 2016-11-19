<?php

namespace myDelivery\Http\Controllers;

use Illuminate\Http\Request;

use myDelivery\Http\Requests\UserRequest;
use myDelivery\Models\User;
use myDelivery\Models\Client;
use myDelivery\Models\Order;

class UsersController extends Controller
{

    private $userModel;

    public function __construct(User $user) {
        $this->userModel = $user;
        view()->share('totalOrders', Order::totalOrdersWaiting());
    }

    public function index()
    {
        $users = $this->userModel->where('in_use','<>','n')->paginate();
        ///dd($users);
        return view('admin.users.index', compact('users'));
    }

    public function destroy($id){
        $this->userModel
            ->find($id)
            ->update(
                [
                    'in_use' => 'n',
                ]
            );

        $message = 'Usuário removido com sucesso!';
        return redirect()->route('admin.users.index')->withMessageSuccess($message);
    }

    public function create(){
        return view('admin.users.create');
    }

    protected function store(UserRequest $request){

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role')
        ]);

        $message = 'Usuário cadastrado com sucesso!';
        return redirect()->route('admin.users.index')->withMessageSuccess($message);
    }

    public function edit($id){
        $user = $this->userModel->find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, $id){
        $this->userModel->find($id)->update($request->all());
        $message = 'Usuário atualizado com sucesso!';
        return redirect()->route('admin.users.index')->withMessageSuccess($message);
    }

    public function test(){
      return view('auth.password');
    }

    /*
    public function searchClient($data){

        if(is_numeric($data)){
        $datas = Client::where('cell_phone', 'like', "____$data%")
                ->orWhere('phone', 'like', "____$data%")
                ->with(['user'])
                ->get();

        }else
            $datas = User::where('name','iLIKE', "$data%")->with(['client'])->get();

        return json_encode($datas);
    }
     *
     */
}
