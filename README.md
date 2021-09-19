# Braainy Task

## Prerequisites
- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Run 
- Clone the project
  ```
  git clone https://github.com/job-tasks/braainy.git
  cd braainy
  ```

- Build the containers
  ```
  docker-compose build && docker-compose up -d
  ```
  
- Attach to a container
  ```
  docker exec -it braainy_web sh
  ```

- Install dependencies
  ```
  composer install
  ```

- Run migrations and fixtures
  ```
  php bin/console doctrine:migrations:migrate -n 
  php bin/console doctrine:fixtures:load -n   
  ```

- Go to [http://localhost:8088) and login
   ```
   email: admin@admin.com
   password: 123456
   ```
  
- For testing
  ```
  php bin/phpunit
  ```
  
## Additional Information
- in the commit (b2a4837 - Sync to ERP ) I decided to reduce the amount of information
that was initially saved in database, because of a maintenance of data. The better
  solution would be to create all the relations and additional modules, but it was
  not asked in initial task.