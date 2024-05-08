<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
 */

Broadcast::channel('chat.{conversationID}', function (User $user, string $conversationID) {
    if ($user->canJoinConversation($conversationID)) {
        return ['id' => $user->id, 'name' => $user->name];
    }
});