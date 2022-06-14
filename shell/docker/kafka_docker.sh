docker run --name zookeeper \
  -p 2181:2181 \
  -d wurstmeister/zookeeper:latest

## kafka0
docker run --name kafka0 \
  -p 9092:9092 \
  -e KAFKA_ZOOKEEPER_CONNECT=host.docker.internal:2181 \
  -e KAFKA_ADVERTISED_HOST_NAME=host.docker.internal \
  -e KAFKA_ADVERTISED_PORT=9092 \
  -d wurstmeister/kafka:2.12-2.2.0

## ---- run below to be cluster ----

## kafka1
docker run --name kafka1 \
  -p 9093:9092 \
  -e KAFKA_ZOOKEEPER_CONNECT=host.docker.internal:2181 \
  -e KAFKA_ADVERTISED_HOST_NAME=host.docker.internal \
  -e KAFKA_ADVERTISED_PORT=9093 \
  -d wurstmeister/kafka:2.12-2.2.0

## kafka2
docker run --name kafka2 \
  -p 9094:9092 \
  -e KAFKA_ZOOKEEPER_CONNECT=host.docker.internal:2181 \
  -e KAFKA_ADVERTISED_HOST_NAME=host.docker.internal \
  -e KAFKA_ADVERTISED_PORT=9094 \
  -d wurstmeister/kafka:2.12-2.2.0
