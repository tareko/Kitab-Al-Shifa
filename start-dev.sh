#!/bin/sh
cd frontend
ng serve &
cd ../backend
npm run start:server &
cd ../docker
docker-compose up
