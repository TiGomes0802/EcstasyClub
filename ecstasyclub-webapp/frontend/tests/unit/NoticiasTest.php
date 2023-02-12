<?php

namespace frontend\tests\Unit;

use frontend\tests\UnitTester;
use \common\models\Noticias;
use DateTime;

class NoticiasTest extends \Codeception\Test\Unit
{
    public function testFailValidation()
    {
        $noticias = new Noticias();

        $noticias->titulo = null;
        $this->assertFalse($noticias->validate(['titulo']));

        $noticias->titulo = 'SUCG5KVSxel1JOsWU6LCcPANo1';
        $this->assertFalse($noticias->validate(['titulo']));

        $noticias->titulo = 112412;
        $this->assertFalse($noticias->validate(['titulo']));


        $noticias->datanoticia = null;
        $this->assertFalse($noticias->validate(['datanoticia']));

        $noticias->datanoticia = 'data da noticia';
        $this->assertFalse($noticias->validate(['datanoticia']));

        $noticias->datanoticia = 1231415;
        $this->assertFalse($noticias->validate(['datanoticia']));


        $noticias->descricao = null;
        $this->assertFalse($noticias->validate(['descricao']));

        $noticias->descricao = '5zyXzTLjFnW0e5yj81YLZ5RIxC6ReAfVpsxYTNm5djksLYVWxBpo2vH8Fv1xDnkDelkzWeu4nMBfnjzpFPH6As279nZqFRwTaXhQfDOQKtIERLEtQSs9JEIYA291UUwzaZUDrhY0b8Q1rqIh1TbZDzIY31Pp7IomlivdMDdqQ3GEePEBYwSJNYUcFq43YMBsesb8tDMOnbD3BdoN7WXtyKhhMqUPh002EfNmTEbwclpSuvfKtwkxqfyl6dQmIbQm1H6bomWETwvH1VTq8daoyv34SUE9ck1E0qICB3uauHY6hL9TshMN9o889Mg2vd4wCPBZfZ6CzkkeszYQAfnwY0Mw0nOlvb7Iue5kxg6yo7bZma7QNt2zA58iBgMenwlONz4ZwzaZeLulW6rnnYRcNfhNBloA8e7fwr2RCnOovSZevNDzJVHN2NfoyLfw6jrw8ebsVb9nOam0Q0YRhk78OoxiEQfhg36p7PgPgFF2ufS0MncCjz5dY0ibHiZzTYkpzULEoYNbxewbHn90wYHsZwtJE8yTwLMffz45Shna7X8p3gHF5hJfCZnTPw1GxMwgT40NYOwGy3H8nrjU1rn5VWEnMrVcvOXVoihNI8VYpyewShzRNrfo0nNYepGMSEuA7t7fgKQQXrxuaDMDr0LTW5X482GsTpAdXkSM7SEpnkJRsUN1BnzVeUG3BZdquD3Az28ZFJIDzmnMuWvKLoFfn2iTDZfu7hLTbL4MOOpMT4X9kjY';
        $this->assertFalse($noticias->validate(['descricao']));

        $noticias->descricao = 1231415;
        $this->assertFalse($noticias->validate(['descricao']));
        

        $noticias->id_criador = null;
        $this->assertFalse($noticias->validate(['id_criador']));

        $noticias->id_criador = 'testes';
        $this->assertFalse($noticias->validate(['id_criador']));

        $noticias->id_criador = 999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;
        $this->assertFalse($noticias->validate(['id_criador']));

    }

    public function testCorretValidation()
    {
        $noticias = new Noticias();

        $noticias->titulo = 'teste';
        $this->assertTrue($noticias->validate(['titulo']));

        $input = strtotime('2012-08-08T23:30:00');
        $newdatetime = date('Y-m-d H:i:s',$input);
        $noticias->datanoticia = $newdatetime;
        $this->assertTrue($noticias->validate(['datanoticia']));

        $noticias->descricao = 'descricao'; 
        $this->assertTrue($noticias->validate(['descricao']));
        
        $noticias->id_criador = 1;
        $this->assertTrue($noticias->validate(['id_criador']));
    }

    public function testAddBDValidation()
    {
        $noticias = new Noticias();

        $titulo = "titulo";
        $input = strtotime('2012-08-08T23:30:00');
        $datanoticia = date('Y-m-d H:i:s',$input);
        $descricao = "descricao";
        $id_criador = 1;

        $noticias->titulo = $titulo;
        $noticias->datanoticia = $datanoticia;
        $noticias->descricao = $descricao;
        $noticias->id_criador = $id_criador;
        $noticias->save();

        $this->tester->seeRecord('common\models\Noticias', ['titulo' => $titulo, 'datanoticia' => $datanoticia, 'descricao' => $descricao, 'id_criador' => $id_criador]);

        $id = $noticias->id;

        //Update
        $noticias = Noticias::findOne(['id' => $id]);

        $titulo = "Outro titulo";
        $input = strtotime('2020-08-08T23:30:00');
        $datanoticia = date('Y-m-d H:i:s',$input);
        $descricao = "Outra descricao";
        $id_criador = 1;

        $noticias->titulo = $titulo;
        $noticias->datanoticia = $datanoticia;
        $noticias->descricao = $descricao;
        $noticias->id_criador = $id_criador;
        $noticias->save();

        $this->tester->seeRecord('common\models\Noticias', ["id" => $id, 'titulo' => $titulo, 'datanoticia' => $datanoticia, 'descricao' => $descricao, 'id_criador' => $id_criador]);

        //Delete
        Noticias::findOne(['id' => $id])->delete();

        $this->tester->dontSeeRecord('common\models\Noticias', ["id" => $id, 'titulo' => $titulo, 'datanoticia' => $datanoticia, 'descricao' => $descricao, 'id_criador' => $id_criador]);
    }
}