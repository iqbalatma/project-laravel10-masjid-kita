<?php

namespace App\Enums;

use phpDocumentor\Reflection\Types\Self_;

enum PermissionEnum: string
{
//    DISTRCIT
    case DISTRICT_INDEX = "district.index";
    case DISTRICT_STORE = "district.store";
    case DISTRICT_UPDATE = "district.update";
    case DISTRICT_DESTROY = "district.destroy";


//    MOSQUE
    case MOSQUE_INDEX = "mosque.index";
    case MOSQUE_STORE = "mosque.store";
    case MOSQUE_UPDATE = "mosque.update";
    case MOSQUE_DESTROY = "mosque.destroy";

//    MOSQUE TRANSACTION
    case MOSQUE_TRANSACTION_INDEX = "mosque.transaction.index";
    case MOSQUE_TRANSACTION_STORE = "mosque.transaction.store";
    case MOSQUE_TRANSACTION_APPROVAL = "mosque.transaction.approval";

//    PERMISSION
    case PERMISSION_INDEX = "permission.index";

//    SUBDISTRCIT
    case SUBDISTRICT_INDEX = "subdistrict.index";
    case SUBDISTRICT_STORE = "subdistrict.store";
    case SUBDISTRICT_UPDATE = "subdistrict.update";
    case SUBDISTRICT_DESTROY = "subdistrict.destroy";

//    TRANSACTION
    case TRANSACTION_INDEX = "transaction.index";
    case TRANSACTION_APPROVAL = "transaction.approval";

//    TRANSACTION TYPE
    case TRANSACTION_TYPE_INDEX = "transaction.type.index";
    case TRANSACTION_TYPE_STORE = "transaction.type.store";
    case TRANSACTION_TYPE_UPDATE = "transaction.type.update";
    case TRANSACTION_TYPE_DESTROY = "transaction.type.destroy";

//    USER MANAGEMENT
    case USER_MANAGEMENT_INDEX = "user.management.index";
    case USER_MANAGEMENT_STORE = "user.management.store";
    case USER_MANAGEMENT_UPDATE = "user.management.update";
    case USER_MANAGEMENT_DESTROY = "user.management.destroy";
    case USER_MANAGEMENT_CHANGE_STATUS_ACTIVE = "user.management.change.status.active";

//    VILAGE
    case VILLAGE_INDEX = "village.index";
    case VILLAGE_STORE = "village.store";
    case VILLAGE_UPDATE = "village.update";
    case VILLAGE_DESTROY = "village.destroy";

    case ROLE_INDEX = "role.index";
    case ROLE_CREATE = "role.create";
    case ROLE_EDIT = "role.edit";
    case ROLE_STORE = "role.store";
    case ROLE_UPDATE = "role.update";
    case ROLE_DESTROY = "role.destroy";

    public static function casesName()
    {
        $data = [];
        foreach (PermissionEnum::cases() as $permission) {
            $data[$permission->name] = $permission->value;
        }

        return $data;
    }
}
