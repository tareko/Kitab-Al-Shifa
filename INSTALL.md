# Install Instructions

1. Go to the directory where you want the to install to
2. `git clone git://github.com/tareko/Kitab-Al-Shifa.git kitab`
3. `cd kitab`

4. Initialize submodules:
```
git submodule init
git submodule update
cd frontend
npm install
cd ../backend
npm install
```

# Startup Instructions

```
cd docker
docker-compose up -d
cd ../frontend
ng serve &
cd ../backend
npm run start:server &
```

I suggest instead starting the above 3 commands in separate terminals or screens.

# Running on a production server
```
cd frontend
ng build --prod
cd ../backend
PORT=3000 pm2 start bin/www -l ../logs/backend.log --time #may change log file or port
```

* Edit .env in backend from .env.sample

Consider using PM2 as in [these instructions](https://www.digitalocean.com/community/tutorials/how-to-set-up-a-node-js-application-for-production-on-ubuntu-18-04).

# Development instructions
```
sudo npm install -g @angular/cli
cd docker
cp .env.sample .env
docker-compose -f docker-compose.yml -f docker-compose.dev.yml up
```

The dev server's ports are:

 * Frontend: http://localhost:4200
 * Backend: http://localhost:3000
 * Mailhog: http://localhost:9125
