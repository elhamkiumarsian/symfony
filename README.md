
# Run the application:
  1. clone the project 
  2. Go to the project directory
  3. make sure you update .env like DATABASE_URL,REDIS_HOST...
  4. Run composer install
  5. Run php bin/console doctrine:database:create to create your DB
  6. Run php bin/console doctrine:database:migrate to migrate all migrations
  7. with URL:http://localhost:8080/register you can create new User with fileds:email,password,type 
  8. with URL:http://localhost:8080/login you can login with the user you may created before 
  9. aftre login depending user_type you will be landing to "/employee" or "/contractor"
  10. for unit testing: it will automatically create 2 users:
				employee@gmail.com with type of employee 
				contractor@gmail.com with type of contractor
  and then redirect them to the url depend on the type of user.
  11. Run php bin/phpunit  for unit testing
