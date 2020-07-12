var express = require('express');
var auth = require('./auth');
var router = express.Router();
var Oncall = require('../models/oncall');
var twilio = require('twilio');
var client = new twilio(process.env.twilio_accountSid, process.env.twilio_authToken);


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
      console.log('Save failed');
      console.log(oncall);
    });

    // Execute all the things that have to happen for administrators
    runAdminSave(req);

    // Execute all the things that have to happen to notify other users
    startOnCallBlast(req);
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

/**
 * The commands to run to notify administrators that an on-call event has been
 * initiated
 *
 * @param  {[type]}   req  Incoming request
 * @param  {[type]}   res  [description]
 * @param  {Function} next [description]
 * @return {[type]}        [description]
 */
function runAdminSave(req, res, next) {
      // Make Twilio call and then SMS.
      // Add 1s delay so as to not overwhelm twilio
      console.log('Admin blast started');
      makeSms(req);
      //Reformat env into array and iterate through with forEach
      var index = 0;
      process.env.twilio_destNumber.split(",")
        .forEach(function(destNumber, index){
          //setTimeout is async, so index * number of calls is needed to modify this
          setTimeout(function() {makeCall(destNumber)}, (index + 1) * 1000);
        });
}

/**
 * Function to contact all users about a sick person
 * @return {[type]} [description]
 */
function startOnCallBlast(req, res, next) {
  console.log('Oncall blast started - nothing here yet')
}

function makeCall(destNumber) {
  // Create twilio call
  client.calls
        .create({
           url: process.env.server_base + '/twilio/oncall-initiated.xml',
           to: destNumber,
           from: process.env.twilio_fromNumber,
           method: 'GET'
         })
        .then(call => {
          console.log("Call sent with SID " + call.sid);
          // console.log(call)
        })
        .catch(call => {
          console.log('Failed to call to Twilio');
          console.log(call.code);
        }).done();
}

// Send SMS messages to those who want to be notified this way
function makeSms(req) {

  // Initialize the twilio messaging service as per
  // https://www.twilio.com/blog/2017/12/send-bulk-sms-twilio-node-js.html
  const service = client.notify.services(process.env.twilio_messaging_service_sid);

  // Convert .env setting (string) to an array
  const numbers = process.env.twilio_destNumber.split(",");

  // Map the numbers to a JSON string that can be used by twilio
  const bindings = numbers.map(number => {
        return JSON.stringify({ binding_type: 'sms', address: number })
      });

  service.notifications
    .create({
          toBinding: bindings,
          body: 'Hi there! ' + req.body.user_name + ' has initiated an on-call emergency. Please go online to check out the details!'
    })
    .then(notification => {
          console.log(notification);
    })
    .catch(err => {
          console.error(err);
    })
    .done();
}
