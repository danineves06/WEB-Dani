<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use App\Repositories\AlunoRepository;
use App\Repositories\CursoRepository;
use App\Repositories\TurmaRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AlunoController extends Controller
{

    protected $repository;

    public function __construct(){
            $this->repository = new AlunoRepository();
    }

    public function index() {
        
        $data = $this->repository->SelectAll();
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

        
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        $objTurma = (new TurmaRepository())->findById($request->turma_id);
        $objUser = (new UserRepository())->findById($request->user_id);


        if(isset($objCurso) && isset($objTurma)) {

            $obj = new Aluno();
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->cpf = mb_strtoupper($request->cpf, 'UTF-8');
            $obj->email = mb_strtolower($request->email, 'UTF-8');
            $obj->password = Hash::make($request->password);
            $obj->turma()->associate($objTurma);
            $obj->curso()->associate($objCurso);
            $obj->user()->associate($objUser);
            $this->repository->save($obj);
            return "<h1>Store - OK!</h1>";
        }
        return "ERRO";
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
        $objCurso = (new CursoRepository())->findById($request->curso_id);
        $objTurma = (new TurmaRepository())->findById($request->turma_id);
        $objUser = (new UserRepository())->findById($request->user_id);

        if(isset($obj) && isset($objCurso) && isset($objTurma)) {
            $obj->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj->cpf = mb_strtoupper($request->cpf, 'UTF-8');
            $obj->email = mb_strtolower($request->email, 'UTF-8');
            $obj->password = Hash::make($request->password);
            $obj->turma()->associate($objTurma);
            $obj->curso()->associate($objCurso);
            $obj->user()->associate($objUser);
            $this->repository->save($obj);
            return "<h1>Update - OK!</h1>";
        }
        return "<h1>Update - Not found Aluno!</h1>";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->repository->delete($id)) {
            return "<h1>Delete - OK!</h1>";
        }
        
        return "<h1>Delete - Not found Nivel!</h1>";
    }
}