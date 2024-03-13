<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Todo;
// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel("todo.{id}", function (Todo $todo, $id) {
    return $todo->id == (int)$id;
});
