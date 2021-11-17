<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doubt extends Model
{
    protected $table = 'pergunta';
    public $timestamps = true;
    protected $fillable = ['titulo', 'descricao', 'usuario_id', 'resolvida'];
    protected $appends = ['links'];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'pergunta_id');
    }

    public function user()
    {
        return $this->hasOne(UserDev::class);
    }

    public function getLinksAttribute(): array
    {
        return [
            'self' => '/api/doubt/' . $this->pergunta_id . '/answers/' . $this->id,
            'respostas' => '/api/doubt/' . $this->id . '/answers',
            'autor' => '/api/user/' . $this->usuario_id,
        ];
    }
}
