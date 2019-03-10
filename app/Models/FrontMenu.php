<?php

namespace Laraspace\Models;

use Illuminate\Database\Eloquent\Model;

class FrontMenu extends Model
{
    public function FrontSubMenu()
    {
        return $this->HasMany('\Laraspace\Models\FrontSubMenu', 'menu_id', 'id');
    }
}
