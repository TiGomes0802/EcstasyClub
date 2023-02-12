<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use common\models\Tipoevento;

use DateTime;

class EventoCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('/');
        $I->see('Sign in to start your session','p');
        $I->fillField('#username', 'gomes0802');
        $I->fillField('#password', '12345678');
        $I->click('Sign In');
        $I->see('Olá Tiago Gomes');
        $I->click('Eventos');
    }

    
    public function createWithEmptyFields(FunctionalTester $I)
    {
        $I->click('Create Eventos');
        $I->fillField('#eventos-numbilhetesdisp', '');
        $I->click('Submit');
        $I->see('Nome não pode estar vazio');
        $I->see('Descrição não pode estar vazio');
        $I->see('Imagem do cartaz não pode estar vazio');
        $date = new DateTime();
        $min = $date->format('Y-m-d H:i');
        $I->see('Data minima é ' . $min);
        $I->see('Número de bilhetes não pode estar vazio');
        $I->see('Preço não pode estar vazio');
    }

    public function createAndUpdateSuccessfully(FunctionalTester $I)
    {
                
        $nome = 'teste123456789';
        $descricao = 'teste';
        $imagefile = 'EcstasyClubLogo.png';
        $dataevento = '2500-06-13T23:30';
        $numbilhetesdisp = '650';
        $preco = '15';
        $tipo_evento = 'Rock';

        $I->click('Create Eventos');
        $I->fillField('#eventos-nome', $nome);
        $I->fillField('#eventos-descricao', $descricao);
        $I->attachFile('#eventos-imagefile', $imagefile);
        $I->fillField('#eventos-dataevento', $dataevento);
        $I->fillField('#eventos-numbilhetesdisp', $numbilhetesdisp);
        $I->fillField('#eventos-preco', $preco);
        $I->selectOption('#eventos-id_tipo_evento', $tipo_evento);
        $I->click('Submit');

        $tipoevento = Tipoevento::findOne(['tipo' => $tipo_evento]);

        $I->seeRecord('common\models\Eventos', [
            'nome' => $nome,
            'descricao' => $descricao,
            'dataevento' => '2500-06-13 23:30:00',
            'numbilhetesdisp' => $numbilhetesdisp,
            'preco' => $preco,
            'estado' => 'ativo',
            'id_tipo_evento' => $tipoevento->id,
        ]);

        $I->see($nome);
        $I->see($numbilhetesdisp);
        $I->see('0');
        $I->see('0.00€');
        $I->see($preco . '.00€');
        $I->see('2500-06-13 23:30:00');
        $I->see($tipo_evento);
        $I->see('Tiago Gomes');

        //Update
        
        $I->click('Update');

        $nome = 'teste987654321';
        $descricao = 'teste987654321';
        $dataevento = '2750-06-13T23:30';
        $preco = '25';
        $tipo_evento = 'Trap';

        $I->fillField('#eventos-nome', $nome);
        $I->fillField('#eventos-descricao', $descricao);
        $I->fillField('#eventos-dataevento', $dataevento);
        $I->fillField('#eventos-preco', $preco);
        $I->selectOption('#eventos-id_tipo_evento', $tipo_evento);
        $I->selectOption('#eventos-estado', 'Cancelado');
        $I->click('Submit');

        $tipoevento = Tipoevento::findOne(['tipo' => $tipo_evento]);

        $I->seeRecord('common\models\Eventos', [
            'nome' => $nome,
            'descricao' => $descricao,
            'dataevento' => '2750-06-13 23:30:00',
            'numbilhetesdisp' => $numbilhetesdisp,
            'preco' => $preco,
            'estado' => 'cancelado',
            'id_tipo_evento' => $tipoevento->id,
        ]);

        $I->see($nome);
        $I->see($numbilhetesdisp);
        $I->see('0');
        $I->see('0.00€');
        $I->see($preco . '.00€');
        $I->see('2750-06-13 23:30:00');
        $I->see($tipo_evento);
        $I->see('Tiago Gomes');
    }
}
