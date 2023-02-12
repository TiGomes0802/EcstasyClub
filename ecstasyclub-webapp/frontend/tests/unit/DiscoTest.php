<?php


namespace frontend\tests\Unit;

use frontend\tests\UnitTester;
use common\models\Disco;

class DiscoTest extends \Codeception\Test\Unit
{

    public function testFailValidation()
    {
        $Disco = new Disco();

        $Disco->nome = null;
        $this->assertFalse($Disco->validate(['nome']));

        $Disco->nome = "zuLiiViGNErOvWuFpcdyHMLflc";
        $this->assertFalse($Disco->validate(['nome']));

        $Disco->nome = 1;
        $this->assertFalse($Disco->validate(['nome']));

        $Disco->nome = 1.5;
        $this->assertFalse($Disco->validate(['nome']));


        $Disco->nif = null;
        $this->assertFalse($Disco->validate(['nif']));

        $Disco->nif = "1111b1111";
        $this->assertFalse($Disco->validate(['nif']));

        $Disco->nif = "1111111111";
        $this->assertFalse($Disco->validate(['nif']));

        $Disco->nif = "11111111";
        $this->assertFalse($Disco->validate(['nif']));

        $Disco->nif = "1111.1111";
        $this->assertFalse($Disco->validate(['nif']));
        
        $Disco->nif = 1111.1111;
        $this->assertFalse($Disco->validate(['nif']));


        $Disco->localidade = null;
        $this->assertFalse($Disco->validate(['localidade']));

        $Disco->localidade = "zuLiiViGNErOvWuFpcdyHMLflc";
        $this->assertFalse($Disco->validate(['localidade']));

        $Disco->localidade = 1;
        $this->assertFalse($Disco->validate(['localidade']));

        $Disco->localidade = 1.5;
        $this->assertFalse($Disco->validate(['localidade']));


        $Disco->codpostal = null;
        $this->assertFalse($Disco->validate(['codpostal']));

        $Disco->codpostal = "zuLiiVi";
        $this->assertFalse($Disco->validate(['codpostal']));

        $Disco->codpostal = "11123211";
        $this->assertFalse($Disco->validate(['codpostal']));

        $Disco->codpostal = "1112-q11";
        $this->assertFalse($Disco->validate(['codpostal']));

        $Disco->codpostal = "111-111";
        $this->assertFalse($Disco->validate(['codpostal']));

        $Disco->codpostal = "111-1111";
        $this->assertFalse($Disco->validate(['codpostal']));

        $Disco->codpostal = "2625b35";
        $this->assertFalse($Disco->validate(['codpostal']));

        $Disco->codpostal = 2625035;
        $this->assertFalse($Disco->validate(['codpostal']));

        $Disco->codpostal = 2625.035;
        $this->assertFalse($Disco->validate(['codpostal']));


        $Disco->morada = null;
        $this->assertFalse($Disco->validate(['morada']));
        
        $Disco->morada = "zuLiiViGNErOvWuFpcdyHMLflczuLiiViGNErOvWuFpcdyHMLflc";
        $this->assertFalse($Disco->validate(['morada']));

        $Disco->morada = 1.5;
        $this->assertFalse($Disco->validate(['morada']));


        $Disco->lotacao = null;
        $this->assertFalse($Disco->validate(['lotacao']));

        $Disco->lotacao = "cinquenta";
        $this->assertFalse($Disco->validate(['lotacao']));

    }

    public function testCorretValidation()
    {
        $Disco = new Disco();

        $Disco->nome = "Bruno Lopes";
        $this->assertTrue($Disco->validate(['nome']));


        $Disco->nif = "249024306";
        $this->assertTrue($Disco->validate(['nif']));
  

        $Disco->localidade = "Lisboa";
        $this->assertTrue($Disco->validate(['localidade']));


        $Disco->codpostal = "2625-242";
        $this->assertTrue($Disco->validate(['codpostal']));

        
        $Disco->morada= "Rua matiaz damasio";
        $this->assertTrue($Disco->validate(['morada']));


        $Disco->lotacao = 600;
        $this->assertTrue($Disco->validate(['lotacao']));
    }

    function testAddBDValidation()
    {
        //Create
        $Disco = new Disco();

        $nome = "Pedro";
        $nif = "249024300";
        $localidade = "Porto";
        $codpostal = "2660-034";
        $morada = "Rua malaquias siga";
        $lotacao = 300;

        $Disco->nome = $nome;
        $Disco->nif = $nif;
        $Disco->localidade = $localidade;
        $Disco->codpostal = $codpostal;
        $Disco->morada = $morada;
        $Disco->lotacao = $lotacao;

        $Disco->save();

        $this->tester->seeRecord("common\models\Disco", ['nome' => $nome, "nif" => $nif, "localidade" => $localidade, "codpostal" => $codpostal, "morada" => $morada, "lotacao" => $lotacao]);

        $id = $Disco->id;


        //Update

        $Disco = Disco::findOne(['id'=> $id]);

        $nome = "Jose";
        $nif = "249024355";
        $localidade = "Braga";
        $codpostal = "2660-134";
        $morada = "Rua malaquias torto";
        $lotacao = 400;

        $Disco->nome = $nome;
        $Disco->nif = $nif;
        $Disco->localidade = $localidade;
        $Disco->codpostal = $codpostal;
        $Disco->morada = $morada;
        $Disco->lotacao = $lotacao;

        $Disco->save();

        $this->tester->seeRecord("common\models\Disco", ["id" => $id, 'nome' => $nome, "nif" => $nif, "localidade" => $localidade, "codpostal" => $codpostal, "morada" => $morada, "lotacao" => $lotacao]);


        //Delete

        $Disco = Disco::FindOne(['id'=> $id])->delete();

        $this->tester->dontSeeRecord("common\models\Disco", ["id" => $id, 'nome' => $nome, "nif" => $nif, "localidade" => $localidade, "codpostal" => $codpostal, "morada" => $morada, "lotacao" => $lotacao]);

    }
    
}
