<?php

namespace App\Http\Controllers;

use App\Models\Comprovante;
use Illuminate\Http\Request;
use App\Repositories\ComprovanteRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\AlunoRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class ComprovanteController extends Controller
{

    protected $repository;

    public function __construct(){
            $this->repository = new ComprovanteRepository();
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

        
        $objCategoria = (new CategoriaRepository())->findById($request->categoria_id);
        $objAluno = (new AlunoRepository())->findById($request->aluno_id);
        $objUser = (new UserRepository())->findById($request->user_id);


        if(isset($objCategoria) && isset($objAluno)) {

            $obj = new Comprovante();
            $obj->atividade = mb_strtoupper($request->atividade, 'UTF-8');
            $obj->horas = $request->horas;
            $obj->categoria()->associate($objCategoria);
            $obj->aluno()->associate($objAluno);
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
        $objCategoria = (new CategoriaRepository())->findById($request->categoria_id);
        $objAluno = (new AlunoRepository())->findById($request->aluno_id);
        $objUser = (new UserRepository())->findById($request->user_id);


        if(isset($obj) && isset($objCategoria) && isset($objAluno)) {
            $obj->atividade = mb_strtoupper($request->atividade, 'UTF-8');
            $obj->horas = $request->horas;
            $obj->categoria()->associate($objCategoria);
            $obj->aluno()->associate($objAluno);
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