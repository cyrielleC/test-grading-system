Light grading system.
========================

How to make the app running locally on a computer:
- Docker and docker-compose need to be installed on the computer
- At the root of the repo : 
    - run "docker-compose bulid" to build the containers
    - run "docker-composer up -d" to have them up and running
    - run "docker exec -it boilerplatesymfony_php_1 composer install" to have the php packages installed
    - run "docker exec -it boilerplatesymfony_php_1 php bin/console doctrine:migrations:migrate" to create database
- Hopefully, the application should be running locally at the url "symfony.localhost"

You can add students, edit or delete them, and give them a grade on their edition page. 

CSS was roughly added and obviously needs improvment.

Ideally, the system should be improved and give the possibility to link classes to a school, each class having students and subjects linked to them, with exams being linked to subjects. The grade should not be linked directly to students but be a many to many relation between exams and student, with the mark as additionnal info.



