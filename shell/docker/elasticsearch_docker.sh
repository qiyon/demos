docker run --name es -p 9200:9200 -p 9300:9300 -e "discovery.type=single-node" -d elasticsearch:5.6-alpine
