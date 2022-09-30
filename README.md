# myrightweight

####An html, php and mysql app to track my weight. Begun in 2019

##Stuff to remember
this will run a mysql instance. I'm developing on a server that has mysql installed hence the non standard port for the mysql container
* `docker run  --name ms -p 3307:3306 -e MYSQL_ROOT_PASSWORD=password mysql` 
* `docker exec -it ms bash`

docker run --detach --name=test-mysql --env="MYSQL_TCP_PORT=52000" mysql

* `docker-compose up`
* `docker-compose up --build`
* `docker-compose down`
* `docker image build -t rwweb .`
* `docker container run --name rwweb -p 8080:80 rwweb`

##History
* 9/26/2022 Began conversion to a docker container
* 9/28/2022 It works!
* 9/29/2022 Add to github.com as rightweight for sharing - mostly learning github docker registrey.
