<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;

class BackendLoginCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('/');
        $I->see('Sign in to start your session','p');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->click('Sign In');
        $I->see('Username não pode estar vazio');
        $I->see('Password não pode estar vazio');
    }


    public function signupWithWrongPassword(FunctionalTester $I)
    {
        $I->fillField('#username', 'gomes0802');
        $I->fillField('#password', '123456789');
        $I->click('Sign In');
        $I->see('Incorrect username or password.');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->fillField('#username', 'gomes0802');
        $I->fillField('#password', '12345678');
        $I->click('Sign In');

        $I->see('Olá Tiago Gomes');
    }

}
