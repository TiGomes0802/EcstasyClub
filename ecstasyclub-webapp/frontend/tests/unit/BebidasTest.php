<?php


namespace frontend\tests\Unit;

use frontend\tests\UnitTester;
use common\models\Bebidas;

class BebidasTest extends \Codeception\Test\Unit
{
    public function testFailValidation()
    {
        $Bebidas = new Bebidas();

        $Bebidas->nome = null;
        $this->assertFalse($Bebidas->validate(['nome']));

        $Bebidas->nome = "BrJMzpAkyzQqzCuolewKJDxwXtzDXxxtTOFKWZoIZtarouHNevO";
        $this->assertFalse($Bebidas->validate(['nome']));

        $Bebidas->nome = 1;
        $this->assertFalse($Bebidas->validate(['nome']));

        $Bebidas->nome = 1.5;
        $this->assertFalse($Bebidas->validate(['nome']));
    }

    public function testCorretValidation()
    {
        $Bebidas = new Bebidas();

        $Bebidas->nome = "Licor Beirao";
        $this->assertTrue($Bebidas->validate(['nome']));

    }   

    function testAddBDValidation()
    {
        //Create
        $Bebidas = new Bebidas();

        $nome = "Vodka";

        $Bebidas->nome = $nome;

        $Bebidas->save();

        $this->tester->seeRecord("common\models\Bebidas", ["nome" => $nome] );

        $id = $Bebidas->id;


        //update
        $Bebidas = Bebidas::FindOne(['id'=>$id]);

        $nome = "Safari";

        $Bebidas->nome = $nome;

        $Bebidas->save();

        $this->tester->seeRecord("common\models\Bebidas", ["id" => $id, "nome" => $nome]);


        //Delete
        $Bebidas = Bebidas::FindOne(['id'=>$id])->delete();

        $this->tester->dontSeeRecord("common\models\Bebidas", ["id" => $id, "nome" => $nome]);

    }

}
