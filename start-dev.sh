#!/bin/sh
cd docker
gnome-terminal --tab -- bash -c "docker-compose -f docker-compose.yml -f docker-compose.dev.yml up; exec bash"
cd ../frontend
gnome-terminal --tab -- bash -c "ng serve; exec bash"
wait 10
cd ../backend
gnome-terminal --tab -- bash -c "npm run start:server; exec bash"


