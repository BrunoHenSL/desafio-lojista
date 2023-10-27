<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UsuariosController;
use App\Models\Usuario;
use App\Repositories\UsuarioRepository;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    protected $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
    $this->usuarioRepository = $usuarioRepository;
    }

    public function listarUsuarios()
    {
        $usuarios = $this->usuarioRepository->listarUsuarios();
        
        return response()->json($usuarios); 
    }

    public function criarUsuario()
    {
        
    }

}