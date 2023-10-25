<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
    protected $model;

    public function __construct(Usuario $model)
    {
        $this->model = $model;
    }

    public function listarUsuarios()
    {
        return $this->model->all();
    }

    public function encontrarUsuario($id)
    {
        return $this->model->find($id);
    }

}
