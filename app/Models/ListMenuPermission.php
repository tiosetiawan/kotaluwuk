<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListMenuPermission extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'list_menu_permissions';
}
