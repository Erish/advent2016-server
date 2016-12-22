<?php

class Model_Account extends Orm\Model{
    
 protected static $_properties = array(
     'id',
     'email',
     'password',
     'player_name',
 );
 
 protected static $_table_name = 'account';
 protected static $_primariy = array('id');
 
 public static function login($data){
     
    $query_result = array();
    $result = array(
        'result' => false,
        'player_name' => ''
        );
    

    $query = self::find('all', array(
        'where' => array(
            array('email', $data['email']),
            array('password', $data['password']),
        )
    ));
    
    foreach ($query as $query) {
      array_push($query_result, $query->to_array());
    }
    
    if(!empty($query_result)){
        $result['result'] = true;
        $result['player_name'] = $query['player_name'];
    } else {
        $result['result'] = false;
    }
    
    
    
    return $result;
 }

}

?>