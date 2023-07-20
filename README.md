<h2>First of all, run the following commands:</h2>

-   composer install
-   php artisan migrate --seed

<br><h2>Authentication routes</h2>

-   la-empresa@email.com
-   la-empresa

[POST] http://.../api/v1/login <br>
[POST] http://.../api/v1/logout

<br><h2>Endpoints</h2>

Return all the employees <br>
[GET] http://.../api/v1/employees <br>

Add new employee <br>
[POST] http://.../api/v1/employee <br>

Update an employee by folio <br>
[PUT] http://.../api/v1/employee/{folio} <br>

Add new contract <br>
[POST] http://.../api/v1/contract <br>

Delete a contract by employee_id <br>
[DELETE] http://.../api/v1/contract/{employee_id}
