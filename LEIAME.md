# Projeto  F.A.P. Gestão.

Um sistema para gerenciar pacientes na instituição Waldyr Becker de apoio ao paciente com câncer.

O escopo do sistema:

- Gerenciar Pacientes;
- Gerenciar Profissionais;
- Gerenciar Estoque;
- Gerenciar Atendimentos;
- Gerenciar Doações;
- Gerenciar Empréstimos.

## Feito com Ancora.

Esta é uma ferramenta construída por [Maurício Fauth](https://github.com/mauriciofauth) e [Thiago Nardi](https://github.com/thnardi) para desenvolver aplicativos web. Nós estamos trabalhando dês de 2017 em projetos da [Farol 360](https://farol360.com.br).

## Começando

O núcleo da aplicação foi construído com [Slim 3 Framework](https://www.slimframework.com). Para entender o código você precisa focar nos conceitos de *rotas*, gerenciamento de *dependencias* e ler sobre o seu conceito de [middleware](https://www.slimframework.com/docs/v3/concepts/middleware.html).

Nós criamos um [guide](https://github.com/thnardi/ancora/blob/master/GUIDE.md) (ainda em inglês) para ajuar quem tiver interesse.

### Pré-requisitos

 - php 7+;
 - Composer;
 - Jquery 3;
 - Jquery Validator;
 - Jquery Mask;
 - Bootstrap 3;
 - [Tim Creative Material Kit](https://github.com/creativetimofficial/material-dashboard).


### Guia de Instalação

1) Clone ou faça download do repositório do github
```
git clone git@github.com:farol360/ancora_waldyr_becker.git
```
2) Rode o composer na pasta do seu projeto para baixar e instalar as dependencias do projeto.
```
composer install
```
3) copie o arquivo `.env.edit` para `.env` para editar as informações do banco
```
cp .env.edit .env
```
4) crie o seu banco local e edite as informações do `.env`

5) rode o comando migrate no seu projeto para obter o banco de dados da aplicação
```
vendor/bin/phinx migrate
```
6) rode sua aplicação localmente utilizando a pasta public_html como raiz.
```
php -S localhost:8080 -t public_html/
```
## Membros do projeto F.A.P. Gestão:

- **Thiago Nardi** - *Gerente de Projetos, programador principal*
- **Pedro Henrique** - *Aprendiz*

## Autores do Ancora

- **Maurício Fauth** - *Initial work*
- **Thiago Nardi**

## License

This project is licensed under the MIT License - see the [LICENSE](https://github.com/thnardi/ancora/blob/master/LICENSE) file for details.

