<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Server Votes
 *
 * @author  Ryan Sullivan (kayoticsully@gmail.com)
 */
class Servervote extends ActiveRecord\Model {
   static $table_name = 'server_votes';
   static $belongs_to = array(
         array('User'),
         array('Server')
   );
}