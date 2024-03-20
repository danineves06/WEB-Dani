<?php

namespace App\Http\Controllers;

use App\Models\Declaracao;
use Illuminate\Http\Request;
use App\Repositories\DeclaracaoRepository;
use App\Repositories\AlunoRepository;
use App\Repositories\ComprovanteRepository;
use Illuminate\Support\Facades\Hash;

class DeclaracaoController extends Controller
{

    protected $repository;

    public function __construct(){
            $this->repository = new DeclaracaoRepository();
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

        
        $objAluno = (new AlunoRepository())->findById($request->aluno_id);
        $objcomprovante = (new ComprovanteRepository())->findById($request->comprovante_id);


        if(isset($objAluno) && isset($objcomprovante)) {

            $obj = new Declaracao();
            $obj->data = $request->data;
            $obj->hash = Hash::make($request->hash);
            $obj->aluno()->associate($objAluno);
            $obj->comprovante()->associate($objcomprovante);
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
        $objAluno = (new AlunoRepository())->findById($request->aluno_id);
        $objcomprovante = (new ComprovanteRepository())->findById($request->comprovante_id);


        if(isset($obj) && isset($objAluno) && isset($objcomprovante)) {
           
            $obj = new Declaracao();
            $obj->data = $request->data;
            $obj->hash = Hash::make($request->hash);
            $obj->aluno()->associate($objAluno);
            $obj->comprovante()->associate($objcomprovante);
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