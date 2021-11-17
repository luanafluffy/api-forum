<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'resposta';
    public $timestamps = true;
    protected $fillable = ['comentario', 'resolvido', 'usuario_id', 'pergunta_id'];
    protected $appends = ['links'];

    public function doubts()
    {
        return $this->belongsTo(Doubt::class);
    }

    public function getResolvidoAttribute($resolvido): bool
    {
        return $resolvido;
    }

    public function getLinksAttribute(): array
    {
        return [
            'self' => '/api/doubt/' . $this->pergunta_id . '/answers/' . $this->id,
            'respostas' => '/api/doubt/' . $this->pergunta_id . '/answers/details',
            'autor' => '/api/user/' . $this->usuario_id,
        ];
    }
}
