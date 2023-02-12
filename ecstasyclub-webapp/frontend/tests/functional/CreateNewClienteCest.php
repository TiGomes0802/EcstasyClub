<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class CreateNewClienteCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('/');
        $I->see('Signup');
        $I->click('Signup');
        $I->see('REGISTAR');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->click('Submit');
        $I->seeValidationError('Nome não pode estar vazio');
        $I->seeValidationError('Apelido não pode estar vazio');
        $I->seeValidationError('Username não pode estar vazio');
        $I->seeValidationError('Password não pode estar vazio');
        $I->seeValidationError('Email não pode estar vazio');
        $I->seeValidationError('Sexo não pode estar vazio');
        $I->seeValidationError('Data de nascimento não pode estar vazio');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->fillField('#nome', 'teste');
        $I->fillField('#apelido', 'teste');
        $I->fillField('#username', 'teste');
        $I->fillField('#password', '12345678');
        $I->fillField('#passwordrepet', '12345678');
        $I->fillField('#email', 'teste@email.com');
        $I->selectOption('#sexo', 'Masculino');
        $I->fillField('#date', '2000-06-13');
        $I->click('Submit');

        $I->seeRecord('common\models\Userprofile', [
            'nome' => 'teste',
            'apelido' => 'teste',
            'sexo' => 'masculino',
            'datanascimento' => '2000-06-13',
        ]);

        $I->see('Login');
        $I->click('Login');
        
        $I->fillField('#username', 'teste');
        $I->fillField('#password', '12345678');
        $I->click('#login');

        $I->see('Logout (teste)');
    }
}
