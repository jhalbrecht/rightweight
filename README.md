# rightweight

#### An html, php and mysql app to track my weight. Begun in 2019

## Stuff to remember
this will run a mysql instance. 

* `docker run  --name ms -p 3306:3306 -e MYSQL_ROOT_PASSWORD=password mysql` 
* `docker exec -it ms bash`

docker run --detach --name=test-mysql --env="MYSQL_TCP_PORT=52000" mysql

* `docker-compose up`
* `docker-compose up --build`
* `docker-compose down`
* `docker image build -t rwweb .`
* `docker container run --name rwweb -p 8080:80 rwweb`
* `docker login` I created an access token in my account and used that as a password
* `docker tag rwweb:latest jhalbrecht/rwweb:0.7`
* `docker push jhalbrecht/rwweb:0.7`

##History
* 9/26/2022 Began conversion to a docker container
* 9/28/2022 It works!
* 9/29/2022 Add to github.com as rightweight for sharing - mostly learning github docker registrey.
* 9/30/2022 Pushed to docker hub https://hub.docker.com/r/jhalbrecht/rwweb
* 10/1/2022 Implemented .env file.
