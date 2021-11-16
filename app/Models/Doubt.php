<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doubt extends Model
{
    protected $table = 'pergunta';
    public $timestamps = true;
    protected $fillable = ['titulo', 'descricao', 'usuario_id', 'resolvida'];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'pergunta_id');
    }

    public function user()
    {
        return $this->hasOne(UserDev::class);
    }
}
