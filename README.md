# Project F.A.P. Gestão.

A system to manage patients at the Waldyr Becker institution to support the cancer patient.

The scope of the system:

Manage Patients;
Manage Professionals;
Manage Inventory;
Manage Attendance;
Manage Donations;
Manage Loans.

## Made with Ancora.

This is a tool built by [Maurício Fauth](https://github.com/mauriciofauth) and [Thiago Nardi](https://github.com/thnardi) to develop web apps. We have working on this since 2017 in [Farol 360](https://farol360.com.br) jobs.

## Getting Started

The core of application are built with [Slim 3 Framework](https://www.slimframework.com). To understand the code you must focus on slim's *routes* and *dependecies* management and learn about his [middleware](https://www.slimframework.com/docs/v3/concepts/middleware.html) concept.

We create a [guide](https://github.com/thnardi/ancora/blob/master/GUIDE.md) to help anyone who may be interested.

### Prerequisites

 - php 7+;
 - Composer;
 - Jquery 3;
 - Jquery Validator;
 - Jquery Mask;
 - Bootstrap 3;
 - [Tim Creative Material Kit](https://github.com/creativetimofficial/material-dashboard).


### Installing

1) Clone or download the repo files
```
git clone git@github.com:farol360/ancora_waldyr_becker.git
```
2) run composer on project folder to install dependencies
```
composer install
```
3) copy `.env.edit` file to `.env` to edit database infos
```
cp .env.edit .env
```
4) create your local database and modify `.env` to insert your db infos

5) run migrate command on project folder to run `db/migrations` initial database configurations
```
vendor/bin/phinx migrate
```
6) run your php local server. apoint public_html as the root of your server
```
php -S localhost:8080 -t public_html/
```
## Project Members

- **Thiago Nardi** - *Project Manager, programmer*
- **Pedro Henrique** - *Trainee*

## Authors of Ancora

- **Maurício Fauth** - *Initial work*
- **Thiago Nardi**

## License

This project is licensed under the MIT License - see the [LICENSE](https://github.com/thnardi/ancora/blob/master/LICENSE) file for details.


