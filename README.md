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