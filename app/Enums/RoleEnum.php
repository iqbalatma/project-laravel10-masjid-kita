<?php

namespace App\Enums;

enum RoleEnum:string
{
    case SUPERADMIN = "superadmin";
    case ADMIN = "admin";
    case STAFF_INPUT_MASJID = "staff-input-masjid";
    case BENDAHARA_MASJID = "bendahara-masjid";
}
