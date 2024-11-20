<?php

namespace App\Enums;



enum UserRoles : string {
    case ADMIN = "admin";
    case SUPERADMIN = "super-admin";
    case TENANT = "tenant";
 }
