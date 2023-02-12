<?php


namespace frontend\tests\Unit;

use frontend\tests\UnitTester;
use common\models\Vip;

class VipTest extends \Codeception\Test\Unit
{
    public function testFailValidation()
    {
        $vip = new Vip();

        $vip->npessoas = null;
        $this->assertFalse($vip->validate(['npessoas']));

        $vip->npessoas = "npessoas";
        $this->assertFalse($vip->validate(['npessoas']));

        $vip->npessoas = 3.12;
        $this->assertFalse($vip->validate(['npessoas']));


        $vip->descricao = null;
        $this->assertFalse($vip->validate(['descricao']));

        $vip->descricao = "5zyXzTLjFnW0e5yj81YLZ5RIxC6ReAfVpsxYTNm5djksLYVWxBpo2vH8Fv1xDnkDelkzWeu4nMBfnjzpFPH6As279nZqFRwTaXhQfDOQKtIERLEtQSs9JEIYA291UUwzaZUDrhY0b8Q1rqIh1TbZDzIY31Pp7IomlivdMDdqQ3GEePEBYwSJNYUcFq43YMBsesb8tDMOnbD3BdoN7WXtyKhhMqUPh002EfNmTEbwclpSuvfKtwkxqfyl6dQmIbQm1H6bomWETwvH1VTq8daoyv34SUE9ck1E0qICB3uauHY6hL9TshMN9o889Mg2vd4wCPBZfZ6CzkkeszYQAfnwY0Mw0nOlvb7Iue5kxg6yo7bZma7QNt2zA58iBgMenwlONz4ZwzaZeLulW6rnnYRcNfhNBloA8e7fwr2RCnOovSZevNDzJVHN2NfoyLfw6jrw8ebsVb9nOam0Q0YRhk78OoxiEQfhg36p7PgPgFF2ufS0MncCjz5dY0ibHiZzTYkpzULEoYNbxewbHn90wYHsZwtJE8yTwLMffz45Shna7X8p3gHF5hJfCZnTPw1GxMwgT40NYOwGy3H8nrjU1rn5VWEnMrVcvOXVoihNI8VYpyewShzRNrfo0nNYepGMSEuA7t7fgKQQXrxuaDMDr0LTW5X482GsTpAdXkSM7SEpnkJRsUN1BnzVeUG3BZdquD3Az28ZFJIDzmnMuWvKLoFfn2iTDZfu7hLTbL4MOOpMT4X9kjY";
        $this->assertFalse($vip->validate(['descricao']));


        $vip->nbebidas = null;
        $this->assertFalse($vip->validate(['nbebidas']));

        $vip->nbebidas = "nbebidas";
        $this->assertFalse($vip->validate(['nbebidas']));

        $vip->nbebidas = 3.12;
        $this->assertFalse($vip->validate(['nbebidas']));


        $vip->preco = null;
        $this->assertFalse($vip->validate(['preco']));

        $vip->preco = '1teste';
        $this->assertFalse($vip->validate(['preco']));

        $vip->preco = '12,21';
        $this->assertFalse($vip->validate(['preco']));
    }

    public function testCorretValidation()
    {
        $vip = new Vip();

        $vip->npessoas = 12;
        $this->assertTrue($vip->validate(['npessoas']));

        $vip->descricao = "descricao";
        $this->assertTrue($vip->validate(['descricao']));

        $vip->nbebidas = 2;
        $this->assertTrue($vip->validate(['nbebidas']));

        $vip->preco = 55.01;
        $this->assertTrue($vip->validate(['preco']));
    }

    function testAddBDValidation()
    {
        //Create
        $vip = new Vip();

        $npessoas = 12;
        $descricao = "descricao";
        $nbebidas = 2;
        $preco = 25;

        $vip->npessoas = $npessoas;
        $vip->descricao = $descricao;
        $vip->nbebidas = $nbebidas;
        $vip->preco = $preco;

        $vip->save();

        $this->tester->seeRecord('common\models\Vip', ['npessoas' => $npessoas, 'descricao' => $descricao, 'nbebidas' => $nbebidas, 'preco' => $preco]);
        
        $id = $vip->id;

        //Update
        $vip = Vip::findOne(['id' => $id]);

        $npessoas = 24;
        $descricao = "Outra descricao";
        $nbebidas = 32;
        $preco = 55;

        $vip->npessoas = $npessoas;
        $vip->descricao = $descricao;
        $vip->nbebidas = $nbebidas;
        $vip->preco = $preco;

        $vip->save();

        $this->tester->seeRecord('common\models\Vip', ["id" => $id, 'npessoas' => $npessoas, 'descricao' => $descricao, 'nbebidas' => $nbebidas, 'preco' => $preco]);

        //Delete
        Vip::findOne(['id' => $id])->delete();

        $this->tester->dontSeeRecord('common\models\Vip', ['id'=> $id, 'npessoas' => $npessoas, 'descricao' => $descricao, 'nbebidas' => $nbebidas, 'preco' => $preco]);
    }
}
