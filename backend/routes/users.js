var express = require('express');
var router = express.Router();

/* GET users listing. */
router.get('/', function(req, res, next) {
  var physicians = process.env.physicians.split(",");
  var obj = [];
  var i = 0;
  physicians.filter(req.query.q ?
    option => option.toLowerCase().includes(req.query.q):
    option => option)
  .forEach(function(data){
      obj.push({
        "user_id": null,
        "name": data,
        "email": null,
        "telephone": null,
        "pager": null,
      });
      i = i+ 1;
  });
  console.log(obj);
  res.status(200).json(obj);
});


module.exports = router;
