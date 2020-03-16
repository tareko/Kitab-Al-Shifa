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
docker-compose -d up
cd ../frontend
ng serve &
cd ../backend
npm run start:server &
```

I suggest instead starting the above 3 commands in separate terminals or screens.

# Development instructions
```
sudo npm install -g @angular/cli
cd docker
docker-compose -f docker-compose.yml -f docker-compose.dev.yml up
```

The dev server's ports are:

 * Frontend: http://localhost:4200
 * Backend: http://localhost:3000
 * Mailhog: http://localhost:9125
