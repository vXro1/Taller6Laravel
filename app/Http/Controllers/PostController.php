<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException; // Importar la clase de excepción de autorización
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Agregar este trait

class PostController extends Controller
{
    use AuthorizesRequests; // Usar el trait que proporciona el método authorize

    // Mostrar todas las publicaciones del usuario autenticado
    public function index()
    {
        $posts = Auth::user()->publicaciones;
        return view('posts.index', compact('posts'));
    }

    // Mostrar el formulario para crear una nueva publicación
    public function create()
    {
        return view('posts.create');
    }

    // Almacenar una nueva publicación
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required'
        ]);

        // Crear la publicación asociada al usuario autenticado
        Auth::user()->publicaciones()->create($request->only('titulo', 'contenido'));

        return redirect()->route('posts.index');
    }

    // Mostrar una publicación específica
    public function show(Publicacion $post)
    {
        return view('posts.show', compact('post'));
    }

    // Mostrar el formulario para editar una publicación
    public function edit(Publicacion $post)
    {
        // Asegurarse de que el usuario pueda editar esta publicación
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    // Actualizar una publicación específica
    public function update(Request $request, Publicacion $post)
    {
        // Asegurarse de que el usuario pueda actualizar esta publicación
        $this->authorize('update', $post);
        $post->update($request->only('titulo', 'contenido'));
        return redirect()->route('posts.index');
    }

    // Eliminar una publicación
    public function destroy(Publicacion $post)
    {
        // Asegurarse de que el usuario pueda eliminar esta publicación
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index');
    }
    public function dashboard()
    {
        $todas = \App\Models\Publicacion::latest()->with('user')->get();
        return view('dashboard', compact('todas'));
    }

}
