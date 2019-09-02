## 创建 docker bridge 网络
docker network create --driver bridge elk

## 启动ES, 指定网络，docker名称host指向对用conainer的网络
docker run --name es --network elk -p 9200:9200 -p 9300:9300 -e "discovery.type=single-node" -d elasticsearch:7.3.0

## 启动Kibana，指定网络，设置 ES host
docker run --name kibana --network elk -e ELASTICSEARCH_HOSTS=http://es:9200 -p 5601:5601 -d kibana:7.3.0
