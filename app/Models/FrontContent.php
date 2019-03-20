<?php

namespace Laraspace\Models;

use Illuminate\Database\Eloquent\Model;

class FrontContent extends Model
{
    public function FrontPhotoContent()
    {
        return $this->HasOne('\Laraspace\Models\FrontPhotoContent', 'content_id', 'id');
    }
}
