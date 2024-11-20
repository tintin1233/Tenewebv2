<?php


namespace App\Enums;


enum GeneralStatus : string {
    case PENDING = "pending";
    case DONE = "done";
    case ONGOING = "on going";
    case VACANT = "vacant";
    case OCCUPIED = "occupied";
    case PAID = 'paid';
    case UNPAID = "unpaid";
    case VERIFIED = 'verified';
    case REJECT = 'reject';
}
