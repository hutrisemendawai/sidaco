<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Table('ai_tests')]
#[Fillable(['name', 'metadata'])]
class AiTest extends Model
{
    /** @use HasFactory<\Database\Factories\AiTestFactory> */
    use HasFactory;
}
