var submenuOffset = 0;
var socket;
var topics;
// var async_token is loaded in the view

$(document).ready(init);

function init() {
   socket = io.connect(':8000');
   topics = new ObjectList();
   setupListeners(socket);
   getAuthToken();
   loadTopics();
   
   $('.show-comments').on('click', expandThread);
   subMenuScroll();
   adFix();
}

//-------------------------------------
// Backend Functions
//-------------------------------------
function getAuthToken() {
   if(async_token != 0) {
      try {
         var payload = { token: async_token};
         socket.emit('auth', payload, setToken);
      } catch(ex) {
         alert(JSON.stringify(ex));
      }
   }
}

function setupListeners(socket) {
   socket.on('topic', loadTopic);
   socket.on('')
}

function loadTopics() {
   socket.emit('topics');
}

function setToken(data) {
   async_token = data.nextToken;
}

//-------------------------------------
// GUI Functions
//-------------------------------------
function loadTopic(data) {
   var topic = new Topic(data);
   topics.add(topic);
   $('.topics').append(topic.toString());
}


function expandThread() {
   var $this = $(this);
   var $topic = $this.parents('topic');
   var id = $topic.attr('id');
   var $topicThread = $topic.find('.topic-thread');
   var commentCount = $topicThread.find('.comment').size();
   var $history = $topic.find('.get-older');
   var $actions = $topic.find('.actions');
   
   socket.emit('comments', {
      topic : id,
      offset: commentCount
   });
   
   
   $topicThread.toggleClass('expand');
   $history.toggleClass('show');
   $actions.toggleClass('open');
   
   if($topicThread.hasClass('expand')) {
      $this.html('<i class="icon-chevron-up icon-white"></i> ' +
                 '<span class="underline">Close</span>');
   } else {
      $this.html('<i class="icon-comment icon-white" title="older"></i> ' +
                 '<span class="underline">Comments</span>');
   }
}































































function subMenuScroll() {
   submenuOffset = $('#submenu').offset();
   
   $(document).scroll(function(){
      var submenu = $('#submenu');
      var scroll = parseInt($('body').scrollTop()) + 40;
      
      if(scroll >= submenuOffset.top) {
         submenu.addClass('navbar-fixed-top').removeClass('navbar-static-top');
      } else if(scroll < submenuOffset.top) {
         submenu.addClass('navbar-static-top').removeClass('navbar-fixed-top');
      }
      
      
   });
}

function adFix() {
   var scroll = parseInt($('body').scrollTop()) + 40;
   
   if(scroll >= 150) {
      $('#sideAd').css('marginTop', (scroll - 70) + 'px');
   } else if(scroll < 150) {
      $('#sideAd').css('marginTop', '40px');
   }
}