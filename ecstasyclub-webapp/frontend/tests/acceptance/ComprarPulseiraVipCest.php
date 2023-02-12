<?php

namespace frontend\tests\Acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class ComprarPulseiraVipCest
{
    public function comprarPulseriaVipSucesso(AcceptanceTester $I)
    {
        
        $I->amOnPage('/');

        $I->see('Signup');
        $I->click('Signup');
        $I->see('REGISTAR');
        $I->wait(2);

        $username = 'teste' . date("hisv");

        $I->fillField('#nome', 'teste');
        $I->fillField('#apelido', 'teste');
        $I->fillField('#username', $username);
        $I->fillField('#password', '12345678');
        $I->fillField('#passwordrepet', '12345678');
        $I->fillField('#email', $username.'@email.com');
        $I->selectOption('#sexo', 'Masculino');
        $I->fillField('#date', '07-07-2001');
        $I->click('Submit');
        $I->wait(2);

        $I->see('Login');
        $I->click('Login');
        $I->wait(2);

        $I->fillField('#username', $username);
        $I->fillField('#password', '12345678');
        $I->click('#login');
        $I->see('Logout ('.$username.')');
        $I->wait(2);
        
        $I->see('Logout');
        $I->see('Eventos');
        $I->click('Eventos');
        $I->wait(2);
        
        $I->see('LISTA DE EVENTOS');
        $I->click('outro evento');
        $I->wait(2);
        
        $I->see('COMPRAR PULSEIRA');
        $I->click('#comprarpuls');
        $I->wait(2);

        $I->click('#comprarvip');
        $I->see('Escolher Bebidas');
        $I->wait(2);

        $I->selectOption('#bebida1', 'Vodka Grey Goose Citron');
        $I->selectOption('#bebida2', 'Gin Bombay Sapphire');
        $I->wait(2);

        $I->click('Submit');
        $I->wait(2);

        $I->see('PULSEIRA ADQUIRIDA');
        $I->wait(2);
    }
}
