<?php
class Controller_Account extends Controller
{
	
	public function action_test()
	{
		
		$test_account = array(
			'email' => 'test@example.com',
			'password' => 'test',
		);
		
		
		$response = Model_Account::login($test_account);
		
		
		if($response['result'] == true){
		    print_r('login success Player_Name :' . $response['player_name']);
		} else {
		    print_r('login error!');
		}
		
	}
	
	public function post_login()
	{
	    $post   = file_get_contents('php://input');
	    $account = json_decode(file_get_contents('php://input'), 'json');
	    $result = array();
	    
		//データチェック
		if(!isset($account['email']) && !isset($account['password'])){
			$result['error_msg'] = "ユーザー名もしくはパスワードが入力されていません";
			$result['result'] = false;
			
			print_r(Format::forge($result)->to_json());
			return null;
		}
		
		
		$query = Model_Account::login($account);
		
		
		if($query['result'] == true){
		    $result['player_name'] = $query['player_name'];
			$result['result'] = true;
		} else {
		    $result['error_msg'] = "ログインに失敗しました";
			$result['result'] = false;
		}
		
		print_r(Format::forge($result)->to_json());
		return null;
	}
	
}
