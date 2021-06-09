## Environment:
- Ubuntu 20.04
- Docker and docker-composer
- Firefox.
- Sublime text.

## Technologies:
- Relational Database (MySQL): Stores the data the application needs to work.
- Backend (Laravel 5): API to interact with the database.
- Frontend (AngularJS): View to interact with the API.
- Style (Bootstrap): The view must use Bootstrap.
- Execution in Docker: The application will be ready to run in containers, so that it runs in the same conditions for everyone.


## Database

Cause it's simple relational database i not created uml class diagram. I created fk to users table using "id" references to "user_id" in can table. Without cascade on update or delete because we wants conserv this data when user remove a pringels. For the table "can" i created:
+ "id" primary key type increments
+ "nombre_lata" type string , 500
+ "nacionalidad" type string, 100
+ "color principal" type string, 200
+ "when_user" type string, 200
+ "date" type date automatic using date when is added

## Controllers

### PringlesCtrl

This container has the method to manipulate api configuration in route.php. I thinked about create controller and put all functions, but this make angularjs controller not useful cause the methods getIndex it's "load" etc.. like
Route::get('/plano', 'CansController@getIndex')->name('plano');

### Views

In this views the most important thinks it's name and id for input fields and ng-controller="PringlesCtrl".. Other things it's  bootstrap and another loop..

## CRUD
### 1. Add pringels
To make this, i used your template but implementing some improvements like 
+ Validation in controller (regex) with response in json and error code (laravel)
+ Validation in migration table (type, maximum) 
+ Validation in formulary (html)
+ Confirmation to remove (in angularJS)
+ Confirmation to edit (in angularJS)
+ Bootstrap style
+ Modal to edit elements

To create the validation in controller i validate all request data after enter to database, this give me secure and control with all data. It's like little UTM or dmz. I used that because you can set required field in html formulary but anyway the requested data will be puted in the database, with this way that's not happen. For Validation in html i used required filds. The field "when in was added" it's automatic using current date and zone (UCT).

### Remove pringels

Well, for delete any elements or edit the user will be need confirm this with litle alert. This give to user enough information like are you sure wanna remove that?.

#### Show pringels
To show the pringles, i did loop in table located in pringles.html view, but out of the table head because this can make create infinite tables for any element, in the table you can select pringles to edit or remove. This table it's only visible when exists any element. 

#### Edit pringles

Remove pringles, it's probably the most easy. I only need found the requested id and remove it

#### Color

To make this i just used "<input type="color" value="{{cans.color_principal}}" disabled="">" inside loop in my table. It's very simple way without any js, angular or jquery. And it's very smoth for the database. I thinked use ng-style but it's not like my way.

# Execution
Run the project:

```
docker-compose up -d
```

Services:
```
Frontend (APP): http://localhost:8081
Backend (API): http://localhost:8080
Database: 127.0.0.1:3306
```

In addition, if this is the first time you run it (or have created a new migration), you should apply the changes as follows:
```
docker-compose exec app php artisan migrate
```

It is also possible to connect directly to the database to check that the tables have been created successfully. For example, to do this with the mysql tool:
```
mysql -h 127.0.0.1 -u root -p laravel
```
The root password is: secret
