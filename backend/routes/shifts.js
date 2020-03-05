var express = require('express');
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
  const shifts = Shift.find()
    .then(documents => {
      // console.log(documents);
      res.status(201).json({
        message: "Shifts retrieved successfully",
        shifts: documents
      })
    })
    .catch(() => {
      console.log('Shift retrieval failed');
      console.log(shifts);
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
      console.log(result);
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
