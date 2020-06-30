var express = require('express');
var auth = require('./auth');
var router = express.Router();

var Oncall = require('../models/oncall');


/* POST oncalls */
router.post('/', function(req, res, next) {
  const oncall = new Oncall({
    user_name: req.body.user_name,
    date: req.body.date,
    shift_start_time: req.body.shift_start_time,
    message: req.body.message,
  });
  oncall.save()
    .then((createdOncall) => {
      res.status(201).json({
        message: "Oncall added successfully",
        oncallId: createdOncall._id
      });
      console.log('Save successful');
      console.log(oncall);
    })
    .catch(() => {
      res.status(201).json({
        message: "Save failed"
      });
      console.log(oncall);
    })
});

/* GET oncalls listing. */
router.get('/', function(req, res, next) {
  const pageSize = +req.query.pageSize;
  const currentPage = +req.query.page;
  const oncallQuery = Oncall.find();
  let fetchedOncalls;

  if (pageSize && currentPage) {
    oncallQuery
    .skip(pageSize * (currentPage - 1))
    .limit(pageSize);
  }

  oncallQuery
    .then(documents => {
      fetchedOncalls = documents;
      return Oncall.countDocuments();
    })
    .then(count => {
      res.status(200).json({
        message: "Oncalls retrieved successfully",
        oncalls: fetchedOncalls,
        oncallCount: count
      })
    })
    .catch(() => {
      console.log('Oncall retrieval failed');
      console.log(fetchedOncalls);
      res.status(404).json({
        message: "Oncall retrieval failed",
      })
    })
});

/* GET listing for an individual oncall with ID. */
router.get('/:_id', function(req, res, next) {
  Oncall.findById(req.params._id)
    .then(oncall => {
      res.status(201).json(oncall)
    })
    .catch(() => {
      res.status(404).json({
        message: "Oncall " + req.params._id +" not found",
      })
    })
});

router.put('/:_id', function(req, res, next) {
  const oncall = new Oncall({
    _id: req.body._id,
    user_name: req.body.user_name,
    date: req.body.date,
    shift_start_time: req.body.shift_start_time,
    message: req.body.message,
  });
  Oncall.updateOne({ _id: req.params._id}, oncall)
    .then(result => {
      res.status(200).json({message: 'Update successful'});
    });
})

router.delete('/:_id', function(req, res, next) {
  Oncall.deleteOne({ _id: req.params._id })
  .then(() => {
    console.log(req.params._id);
    res.status(200).json({ message: "Oncall deleted" });
  })
  .catch(() => {
    console.log("Failed to delete oncall");
    res.status(401).json({ message: "Oncall not deleted" });
  });
});

module.exports = router;
