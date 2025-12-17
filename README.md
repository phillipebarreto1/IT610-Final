# IT610-Final
## This is my project submission for the IT610 final
## The project aims to integrate a simple php frontend, backend connecting it to a database, and some monitoring with Prometheus
## The website is ran through a docker compose file that orchestrates all these processes and runs them at the same time while connecting them
### to test the project, clone the project
### Next, change directories into fav-games with the command:
```
cd fav-games
```
### It is important that you create a .env file to save all your environment variables. You also have to create a mysql-exporter.cnf and .my.cnf file and add all 3 to your .gitignore
### I forgot to add the cnf files to my gitignore but that is extremely bad practice, and I realize that. Luckily the proccesses will not be run again, especially not with the same information
### After that is done, simply build the app by running:
```
docker compose up --build
```
### Now you can go to localhost:{INSERT YOUR FRONTEND PORT HERE} to test the front end. Again, this is an EXTREMELY basic webpage with basic functionality to test a database connection. You can test around with the other ports to check those connections as well, for example using the Prometheus port will lead you to a page where you can check mysql metrics 
### My aim in this final project was to orchestrate 4 services: a web app, a database, Prometheus monitoring, and a mysql exporter for prometheus. This is something I want to do in the future as my goal is either in cloud engineering or DevOps. I want to add CI/CD as well but my work was too simple and I am happy to ahve gotten multiple services up and working together
### I moved away from my terraria server idea because it was also something I was not too interested in continuing