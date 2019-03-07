<?php

namespace Laraspace\Models;

use Illuminate\Database\Eloquent\Model;

class FrontMenu extends Model
{
    public function FrontSubMenu()
    {
        return $this->HasOne('\Laraspace\Models\Menu', 'menu_id', 'id');
    }
}
