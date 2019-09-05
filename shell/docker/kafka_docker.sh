docker run --name zookeeper -p 2181:2181 -d wurstmeister/zookeeper:3.5
docker run --name kafka -p 9092:9092 --link zookeeper --env KAFKA_ZOOKEEPER_CONNECT=zookeeper:2181 --env KAFKA_ADVERTISED_HOST_NAME=127.0.0.1 --env KAFKA_ADVERTISED_PORT=9092 -d wurstmeister/kafka:0.10.2.1

