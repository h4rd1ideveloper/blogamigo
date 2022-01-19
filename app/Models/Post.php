<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * @var mixed
     */
    private $user_id;
    /**
     * @var mixed
     */
    private $title;
    /**
     * @var mixed
     */
    private $content;
}
