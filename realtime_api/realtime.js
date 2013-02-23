//=============================================
// realtime.js
//---------------------------------------------
// Defines the realtime socket-based api
// for Mineshafter Squared
//---------------------------------------------
// Author: Ryan Sullivan
// Created: 2/15/2013
// Updated: 2/15/2013
//=============================================

// Load all dependencies
var io    = require('socket.io').listen(8000, {log: false});
var DB    = require('models');
var hat   = require('hat');
var rack  = hat.rack();

// Actions
io.sockets.on('connection', function(socket) {
  
  /**
   * Actions
   */
  socket.on('auth', auth);
  socket.on('topics', getTopics);
  socket.on('comments', getComments);
  
  /**
   * Auth - to make sure user is valid
   */
  function auth(data, callback) {
    // validate token
    var token = data.token;
    
    // look up user by token
    var query = {
      where: {
        async_token: token
      }
    }
    // run query
    DB.User.find(query).success(foundUser).error(noUser);
    
    /**
     * Callbacks
     */
    function foundUser(user) {
      // Generate next Token
      var newToken = rack();
      
      // save it
      user.async_token = newToken;
      user.save().success(function(){
        // remember user
        socket.set('user', user, function(){
          // send token
          var payload = { newToken : newToken };
          callback(payload);
        });
      });
    }
    
    function noUser(errors) {
      console.log('NO USER');
    }
  }
  
  /**
   * Get Topics - read only no key needed
   */
  function getTopics(data) {
    // get all topics
    DB.Topic.findAll({limit:10, fetchAssociations: true }).success(function(topics){
      // process each topic
      topics.forEach(processTopic)
    });
    
    function processTopic(topic) {
      topic.getPost().success(function(post){
        var result = {
          topic : topic,
          post  : post
        }
        
        socket.emit('topic', result);
      });
    }
  }
  
  /**
   * Get Comments - read only no key needed
   */
  function getComments(data) {
    var topic = data.topic;
    var offset = data.offset;
    
  }
});