var express = require('express');
var auth = require('./auth');
var router = express.Router();

var Shift = require('../models/shift');


/* POST shifts */
router.post('/', function(req, res, next) {
  const shift = new Shift({
    user_id: req.body.user_id,
    date: req.body.date,
    shifts_type_id: req.body.shifts_type_id,
  });
  shift.save()
    .then((createdShift) => {
      res.status(201).json({
        message: "Shift added successfully",
        shiftId: createdShift._id
      });
      console.log('Save successful');
      console.log(shift);
    })
    .catch(() => {
      res.status(201).json({
        message: "Save failed"
      });
      console.log(shift);
    })
});

/* GET shifts listing. */
router.get('/', function(req, res, next) {
  const pageSize = +req.query.pageSize;
  const currentPage = +req.query.page;
  const shiftQuery = Shift.find();
  let fetchedShifts;

  if (pageSize && currentPage) {
    shiftQuery
    .skip(pageSize * (currentPage - 1))
    .limit(pageSize);
  }

  shiftQuery
    .then(documents => {
      fetchedShifts = documents;
      return Shift.countDocuments();
    })
    .then(count => {
      res.status(200).json({
        message: "Shifts retrieved successfully",
        shifts: fetchedShifts,
        shiftCount: count
      })
    })
    .catch(() => {
      console.log('Shift retrieval failed');
      console.log(fetchedShifts);
      res.status(404).json({
        message: "Shift retrieval failed",
      })
    })
});

/* GET listing for an individual shift with ID. */
router.get('/:_id', function(req, res, next) {
  Shift.findById(req.params._id)
    .then(shift => {
      res.status(201).json(shift)
    })
    .catch(() => {
      res.status(404).json({
        message: "Shift " + req.params._id +" not found",
      })
    })
});

router.put('/:_id', function(req, res, next) {
  const shift = new Shift({
    _id: req.body._id,
    user_id: req.body.user_id,
    date: req.body.date,
    shifts_type_id: req.body.shifts_type_id,
  });
  Shift.updateOne({ _id: req.params._id}, shift)
    .then(result => {
      res.status(200).json({message: 'Update successful'});
    });
})

router.delete('/:_id', function(req, res, next) {
  Shift.deleteOne({ _id: req.params._id })
  .then(() => {
    console.log(req.params._id);
    res.status(200).json({ message: "Shift deleted" });
  })
  .catch(() => {
    console.log("Failed to delete shift");
    res.status(401).json({ message: "Shift not deleted" });
  });
});

module.exports = router;
