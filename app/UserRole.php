<?php

namespace App;

enum UserRole : string {
    case Admin = 'ROLE_ADMIN';
    case Member = 'ROLE_MEMBER';
}
