docker run --name zookeeper \
  -p 2181:2181 \
  -d wurstmeister/zookeeper:3.5

## 关联 zookeeper，配置 zookeeper 地址
docker run --name kafka \
  -p 9092:9092 --link zookeeper \
  -e KAFKA_ZOOKEEPER_CONNECT=zookeeper:2181 \
  -e KAFKA_ADVERTISED_HOST_NAME=127.0.0.1 \
  -e KAFKA_ADVERTISED_PORT=9092 \
  -d wurstmeister/kafka:2.11-0.10.2.2
