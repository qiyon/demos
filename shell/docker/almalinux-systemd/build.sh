docker build -t almasystemd .
docker run --name alma9 -it --privileged -p 15432:5432 -d almasystemd:latest
