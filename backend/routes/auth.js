var express = require('express');
var router = express.Router();
var passport = require('passport');
var bodyParser = require('body-parser');
var LdapStrategy = require('passport-ldapauth').Strategy;
var LocalStrategy = require('passport-local').Strategy;

module.exports = function (app) {
    app.use(passport.initialize());
    app.use(passport.session());

    passport.serializeUser(function (user, done) {
        done(null, user);
    });

    passport.deserializeUser(function (user, done) {
        done(null, user);
    });

};

var OPTS = {
  server: {
    url: 'ldap://localhost:389',
    bindDN: 'cn=root',
    bindCredentials: 'secret',
    searchBase: 'ou=passport-ldapauth',
    searchFilter: '(uid={{username}})'
  }
};

// Load local strategy (test)
passport.use(new LocalStrategy(
    function(username, password, done) {
        if(username === "admin" && password === "admin"){
            return done(null, username);
        } else {
            return done("unauthorized access", false);
        }
    }
));

const auth = () => {
    return (req, res, next) => {
        passport.authenticate('local', (error, user, info) => {
            if(error) res.status(400).json({"statusCode" : 200 ,"message" : error});
            req.login(user, function(error) {
                if (error) return next(error);
                next();
            });
        })(req, res, next);
    }
}

passport.serializeUser(function(user, done) {
    if(user) done(null, user);
});

passport.deserializeUser(function(id, done) {
    done(null, id);
});

// Load LDAP strategy
passport.use(new LdapStrategy(OPTS));

router.post('/login', passport.authenticate('ldapauth', {session: false}), function(req, res) {
  res.send({status: 'ok'});
  res.status(200).json({"statusCode" : 200 ,"message" : "hello"});
});

const isLoggedIn = (req, res, next) => {
    if(req.isAuthenticated()){
        return next()
    }
    return res.status(400).json({"statusCode" : 400, "message" : "not authenticated"})
}

module.exports = router;
