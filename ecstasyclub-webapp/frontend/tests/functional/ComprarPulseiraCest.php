<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class ComprarPulseiraCest
{
    public function _before(FunctionalTester $I)
    {
        
        $I->amOnRoute('/');
        $I->see('Login');
        $I->click('Login');
        
        $I->fillField('#username', 'BerserkerPT');
        $I->fillField('#password', '12345678');
        $I->click('#login');

        $I->see('Logout');
        $I->see('Eventos');

    }

    public function ComprarPulseriaVipSucesso(FunctionalTester $I)
    {
        $I->click('Eventos');
        $I->see('LISTA DE EVENTOS');
        $I->click('outro evento');
        $I->see('Comprarpulseira');
        $I->click('#comprarpuls');
        $I->click('Comprar','#comprarvip');
        $I->see('Escolher Bebidas');
        $I->selectOption('#bebida1', 'Vodka Grey Goose Citron');
        $I->selectOption('#bebida2', 'Gin Bombay Sapphire');
        $I->click('Submit');
        $I->see('PulseiraAdquirida');

    }

    public function ComprarPulseriaNormalSucesso(FunctionalTester $I)
    {
        $I->click('Eventos');
        $I->see('LISTA DE EVENTOS');
        $I->click('outro evento');
        $I->see('Comprarpulseira');
        $I->click('#comprarpuls');
        $I->click('Comprar');
        $I->see('PulseiraAdquirida');
    }
    
    public function ComprarPulseriaGuest(FunctionalTester $I)
    {
        $I->click('Logout');
        $I->see('Signup');
        $I->see('Login');
        $I->click('Eventos');
        $I->see('LISTA DE EVENTOS');
        $I->click('outro evento');
        $I->see('Comprarpulseira');
        $I->click('#comprarpuls');
        $I->see('Login');

    }

}

