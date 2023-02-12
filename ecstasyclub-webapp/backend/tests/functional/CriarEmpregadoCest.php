<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use common\models\User;

class CriarEmpregadoCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('/');
        $I->see('Sign in to start your session','p');
        $I->fillField('#username', 'gomes0802');
        $I->fillField('#password', '12345678');
        $I->click('Sign In');
        $I->see('Olá Tiago Gomes');
        $I->click('Empregados');
        $I->see('Funcionários');
        $I->click('Create Userprofile');
    }

    public function createWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Nome');
        $I->click('Submit');
        $I->see('Nome não pode estar vazio');
        $I->see('Apelido não pode estar vazio');
        $I->see('Username não pode estar vazio');
        $I->see('Password não pode estar vazio');
        $I->see('Email não pode estar vazio');
        $I->see('Sexo não pode estar vazio');
        $I->see('Role não pode estar vazio');
        $I->see('Data de nascimento não pode estar vazio');

    }

    public function CreateEmpregadoMenor(FunctionalTester $I)
    {
        $datanascimento = '2023-01-01';

        $I->see('Nome');
        $I->fillField('#signupempregados-datanascimento', $datanascimento);
        $I->click('Submit');
        $I->see('Nome não pode estar vazio');
        $I->see('Apelido não pode estar vazio');
        $I->see('Username não pode estar vazio');
        $I->see('Password não pode estar vazio');
        $I->see('Email não pode estar vazio');
        $I->see('Sexo não pode estar vazio');
        $I->see('Role não pode estar vazio');
        $I->see('Precisa ser maior de 18 anos');
    }

    public function createEmpregadoSuccessfully(FunctionalTester $I)
    {
        $nome = "Bruno";
        $apelido = "Lopes";
        $Username = "gestor";
        $Password ="123456789";
        $Confirmarpassword = "123456789";
        $Email = "gomes@ecstasyclub.com";
        $Sexo = "Masculino";
        $Role = "Gestor de Eventos";
        $Datadenascimento = "2002-08-08";

        $I->see('Nome');
        $I->fillField('#signupempregados-nome',$nome);
        $I->fillField('#signupempregados-apelido',$apelido);
        $I->fillField('#signupempregados-username',$Username);
        $I->fillField('#signupempregados-password',$Password);
        $I->fillField('#signupempregados-passwordrepet',$Confirmarpassword);
        $I->fillField('#signupempregados-email',$Email);
        $I->selectOption('#signupempregados-sexo',$Sexo);
        $I->selectOption('#signupempregados-role',$Role);
        $I->fillField('#signupempregados-datanascimento', $Datadenascimento);
        $I->click('Submit');
       
        $user = User::findOne(['username' => $Username]);

        $I->seeRecord('common\models\Userprofile',[
            'nome'=> $nome,
            'apelido'=> $apelido,
            'sexo'=> 'masculino',
            'datanascimento'=> $Datadenascimento,
            'user_id'=> $user->id,
        ]);


        $I->seeRecord('common\models\User',[
            'id' => $user->id,
            'username'=> $Username,
            'email'=> $Email,
        ]);
        

        $I->seeRecord('common\models\AuthAssignment',[
            'user_id' => $user->id,
            'item_name' => 'gestor',
        ]);
        

    }

}
