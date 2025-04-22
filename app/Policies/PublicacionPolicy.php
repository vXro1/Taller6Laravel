<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Publicacion;
use Illuminate\Auth\Access\HandlesAuthorization;

class PublicacionPolicy
{
    use HandlesAuthorization;

    // Ver si un usuario puede ver la publicación
    public function view(User $user, Publicacion $publicacion)
    {
        return true; // Asume que todos pueden ver las publicaciones
    }

    // Ver si un usuario puede crear una publicación
    public function create(User $user)
    {
        return true; // Asume que todos los usuarios autenticados pueden crear publicaciones
    }

    // Ver si un usuario puede actualizar una publicación
    public function update(User $user, Publicacion $publicacion)
    {
        return $user->id === $publicacion->user_id;
    }

    // Ver si un usuario puede eliminar una publicación
    public function delete(User $user, Publicacion $publicacion)
    {
        return $user->id === $publicacion->user_id;
    }
}
