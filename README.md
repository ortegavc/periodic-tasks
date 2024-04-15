<p align="center"><a href="#" target="_blank"><img src="https://www.svgrepo.com/show/376121/list-task.svg" width="200" alt="Tasks Logo"></a></p>

# PeriodicTasks

## About

PeriodicTasks is a Laravel web application that allows you to create and manage periodic tasks. Users can set the frequency and duration of tasks, as well as group them into task groups. The application displays pending tasks in a list arranged by date, and users can mark a task as complete.

A detailed description of the features is provided below:

1. Creation of periodic tasks: any user can create periodic tasks (once, every day, every Monday, Wednesday and Friday, every 5th of each month).
2. Task grouping: Users are able to group tasks into task groups.
3. Task listing: The application display a list of pending tasks, organized by date. Pending tasks are grouped into "Tasks Today", "Tasks Tomorrow", "Tasks Next Week", "Tasks in the Near Future", "Tasks in the Future", and "Tasks Overdue". Users are able to mark a task as completed.

### Techincal features
This application was built using some development principles like SOLID, DRY, and the following Laravel Framework features:
- **Route Middleware**: in order to allow only authenticated users access to the tasks management, check the [Web Routes](https://github.com/ortegavc/periodic-tasks/blob/main/routes/web.php#L31).
- **Route Model Binding**: Laravel route model binding provides a convenient way to automatically inject the model instances directly into your routes. Check out the methods on [TaskController](https://github.com/ortegavc/periodic-tasks/blob/main/app/Http/Controllers/TaskController.php).
- **Dependency Injection**: a good way to keep our controller clean is putting the business logic into services, this is demonstrated on [TaskService](https://github.com/ortegavc/periodic-tasks/blob/main/app/Services/TaskService.php) which is injected in store and update methods on [TaskController](https://github.com/ortegavc/periodic-tasks/blob/main/app/Http/Controllers/TaskController.php).
- **Form Request Validation**: another good way to keep our controllers clean is moving the backend validation logic into [Form Requests](https://laravel.com/docs/10.x/validation#form-request-validation), stop by [StoreTaskRequest](https://github.com/ortegavc/periodic-tasks/blob/main/app/Http/Requests/StoreTaskRequest.php) to see this in action, furthermore, you'll find some interesting validation rules.
- **Migrations**: as you may be aware, migrations function similarly to database version control. But there is something I'd like to mention, often we don't mind about DB size, check out the migration for the [Group table](https://github.com/ortegavc/periodic-tasks/blob/main/database/migrations/2024_04_10_144513_create_groups_table.php#L15), since this entity is not expected to have tons of records, it uses a tiny integer field type for the id. Then check out how to reference its foreign key from [Tasks table](https://github.com/ortegavc/periodic-tasks/blob/main/database/migrations/2024_04_10_144521_create_tasks_table.php#L20) migration.
- **Seeders**: [GroupSeeder](https://github.com/ortegavc/periodic-tasks/blob/main/database/seeders/GroupSeeder.php) has some default data to avoid insert this by hand.
- **Blade components**: in order to avoid duplicating code when rendering tasks groups I decided to create the [accordion-item](https://github.com/ortegavc/periodic-tasks/blob/main/resources/views/components/accordion-item.blade.php) component, give a shout to this DRY example in action.
- **PHP Carbon**: when it comes to work with dates, this is the [#1 Lib](https://carbon.nesbot.com/), that's why it comes out of the box with Laravel. Just look at the [TaskService](https://github.com/ortegavc/periodic-tasks/blob/main/app/Services/TaskService.php) and how it reduce the complexity on working with dates.
- **PHP Enums**: a new feature that arrived in PHP 8.1, and I decided to take adavantage when working with the different [Tasks Periods](https://github.com/ortegavc/periodic-tasks/blob/main/app/Enums/TaskPeriod.php).
- **Feature Tests**: the only way to be sure that our apps will work for long time, check the [TaskControllerTest](https://github.com/ortegavc/periodic-tasks/blob/main/tests/Feature/Task/TaskControllerTest.php) and some fancy use cases tested.

## Setup for development
### Prerequisites
- PHP 8.1+
- Composer
- MySQL
### Installation
**Create the database**
```sh
> mysql -u root
> CREATE DATABASE `ptasks` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
**Clone the repo**
```sh
> git clone https://github.com/ortegavc/periodic-tasks.git
```
**Install Laravel dependencies**
```sh
> composer install
```
**Config the .env file**
```sh
> cd periodic-tasks
> cp .env.example .env
> php artisan key:generate
```
Open the .env file from your prefered text editor, and set the values for next params:
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=ptasks
- DB_USERNAME=root
- DB_PASSWORD=
**Run migrations and seed**
```sh
> php artisan migrate --seed
```
**Run application**
```sh
> php artisan serve
```
Go to [http://127.0.0.1:8000](http://127.0.0.1:8000) from your browser, and register your user before login 🚀.
## License

MIT

**Free Software, Hell Yeah!**