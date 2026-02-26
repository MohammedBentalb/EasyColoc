<?php

namespace App;

enum DepenseStatus: string {
    case pending = "PENDING";
    case paid = "PAID";
}
