<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{


    protected $user;

    function __construct(User $user)
    {

        $this->user = $user;
    }

    public function index(){

        return response()->json($this->user->all());

    }

    public function show(int $id){

        $userId = $this->user->UserById($id);
        return response()->json($userId);

    }

   public function createuser(Request $request)
    {

        try {
            $data = $request->all();
            $this->validate($request, [
                'type' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'document' => 'required',
                'password' => 'required',
            ]);
            DB::beginTransaction();
            $data = $this->user->create($data);
            DB::commit();
            return response()->json('registered successfully', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['messege' => $e->getMessage()], 500);
        }
    }

    function update(Request $request, $id)
    {
        try {
            $dados = $request->all();
            $userId = $this->user->returnById($id);

            if (!$userId->all()) return response()->json('unregistered user', 401);
            DB::beginTransaction();
            $user = $this->user->updateById($dados, $id);
            DB::commit();
            return response()->json('successfully updated', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['messege' => $e->getMessage()], 500);
        }
    }

    function delete(int $id)
    {
        try {

            $userId = $this->user->returnById($id);
            if (!$userId->all()) return response()->json('unregistered user', 401);
            DB::beginTransaction();
            $deleteId = $this->user->deleteById($id);
            DB::commit();
            return response()->json('Sucesso', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['messege' => $e->getMessage()], 500);
        }

    }
}
