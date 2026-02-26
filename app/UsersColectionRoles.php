<?php

namespace App;

enum UsersColectionRoles : string
{
    case member = 'ROLE_MEMBER';
    case owner = 'ROLE_OWNER';
}
