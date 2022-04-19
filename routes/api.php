<?php

use Illuminate\Support\Facades\Route;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

Route::middleware(['auth:api', 'scopes:accounts'])
    ->prefix('accounts')
    ->as('accounts.')
    ->namespace('Accounts\Http\Controllers')
    ->group(base_path('src/Accounts/routes.php'));

Route::middleware(['auth:api', 'scopes:contacts'])
    ->prefix('contacts')
    ->as('contacts.')
    ->namespace('Contacts\Http\Controllers')
    ->group(base_path('src/Contacts/routes.php'));

/**
 * Test RabbitMQ
 */
Route::get('send', function () {
   $connection = new AMQPStreamConnection(
       'rabbitqm',
       5672,
       'user',
       'secret'
   );

   $channel = $connection->channel();

   $channel->queue_declare('envioEmail', false, true, false, false);

   $rabbitMsg = new AMQPMessage('Hello World');
   $channel->basic_publish($rabbitMsg, '', 'envioEmail');

   $channel->close();
   $connection->close();
});
