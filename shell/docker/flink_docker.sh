docker network create flink-network

docker run --name=jobmanager \
    --network flink-network \
    -p 8081:8081 \
    -e FLINK_PROPERTIES="jobmanager.rpc.address: jobmanager" \
    -d flink:1.14 jobmanager

docker run --name=taskmanager0 \
    --network flink-network \
    -e FLINK_PROPERTIES="jobmanager.rpc.address: jobmanager" \
    -d flink:1.14 taskmanager

