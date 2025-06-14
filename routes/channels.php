<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{id1}.{id2}', function ($user, $id1, $id2) {
    $ids = [$id1, $id2];
    return in_array($user->id, $ids);
});
