<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'resposta';
    public $timestamps = true;
    protected $fillable = ['comentario', 'resolvido', 'usuario_id', 'pergunta_id'];

    public function doubts()
    {
        return $this->belongsTo(Doubt::class);
    }
}
