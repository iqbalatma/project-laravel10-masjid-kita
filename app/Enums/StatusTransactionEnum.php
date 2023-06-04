<?php

namespace App\Enums;

enum StatusTransactionEnum:string
{
    case APPROVED = "approved";
    case PENDING = "pending";
    case REJECT = "rejected";
}
