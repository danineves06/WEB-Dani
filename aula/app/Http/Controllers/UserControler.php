<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $repository;

    public function __construct(){
            $this->repository = new UserRepository();
    }

    public function index() {
        
        $data = $this->repository->selectAll();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $obj = new User();
        $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
        $obj->email = mb_strtolower($request->email, 'UTF-8');
        $obj->password = Hash::make($request->password);
        $this->repository->save($obj);
        return "<h1>Store - OK!</h1>";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->repository->findById($id);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $obj = $this->repository->findById($id);

        if(isset($obj)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->email = mb_strtolower($request->email, 'UTF-8');
            $obj->password = Hash::make($request->password);
            $this->repository->save($obj);
            return "<h1>Upate - OK!</h1>";
        }
        return "<h1>Upate - Not found Eixo!</h1>";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->repository->delete($id)) {
            return "<h1>Delete - OK!</h1>";
        }
        
        return "<h1>Delete - Not found Eixo!</h1>";
    }
}
