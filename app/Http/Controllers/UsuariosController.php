<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Repositories\UsuarioRepository;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    protected $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function index()
    {
        $usuarios = $this->usuarioRepository->listar();
        return view('usuarios.index', compact('usuarios'));
    }

    public function show($id)
    {
        $usuario = $this->usuarioRepository->encontrar($id);

        if (!$usuario) {
            return redirect()->route('usuarios.index')->with('error', 'Usuário não encontrado');
        }

        return view('usuarios.show', compact('usuario'));
    }

}