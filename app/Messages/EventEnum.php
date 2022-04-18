<?php

namespace App\Messages;

enum EventEnum: string
{
    case EVENT_CREATED = 'Finalizou o cadastro de um novo registro';
    case EVENT_UPDATED = 'Finalizou a atualização do registro';
    case EVENT_UPDATING = 'Iniciou o processo de atualização do registro';
    case EVENT_DELETED = 'Finalizou a exclusão do registro';
    case EVENT_RESTORED = 'Finalizou o processo de desfazer a exclusão do registro';
    case EVENT_FORCE_DELETED ='Finalizou a exclusão definitivamente do registro na base';
}
