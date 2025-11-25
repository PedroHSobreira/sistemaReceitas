<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registroModel extends Model
{
    use HasFactory;
    protected $table='registro';

    //permitir varias atribuições
    protected $fillable = [
        'receita',
        'quantidade',
        'medidas',
        'ingredientes',
        'preparo',
    ];

    //converter 
    protected $casts = [
        'quantidade'    => 'array',
        'medidas'       => 'array',
        'ingredientes'  => 'array',
    ];

}//fim da classe model


