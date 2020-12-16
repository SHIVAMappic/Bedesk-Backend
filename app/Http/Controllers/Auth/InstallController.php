<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Common\CommonUtilsController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\UserTimeSpent;
use Auth;
use App\UserSessionTime;
use DateTime;
use DB;
use Artisan;
use App\User;
use Illuminate\Support\Str;
use App\Mail\verifyEmail;
use App\RoleUser;
use Mail;
use Illuminate\Contracts\Encryption\DecryptException;
use File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class InstallController extends Controller {

	public function store(Request $request){
		if(!$request){
			return redirect()->back()->withInput()->withErrors("Please enter all data.");
		}
		$product_key = encrypt($request->product_key);
		$fields = array('emailId'=>$request->email_ID, 'product_key' => $product_key);
		$url = env('APP_ENV_TYPE').env('APP_MAIN_DOMAIN')."/api/check/tenantStatus?emailId=".$request->email_ID."&product_key=".$product_key;
		$ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt( $ch,CURLOPT_POST, false );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		//curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields));
	    $data = curl_exec($ch);
        if ($data === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
		curl_close( $ch );

		$data = json_decode($data);
		//print_r($data);
		//print_r($data->result->id);
		//exit();

		if(!$data || $data->status == 204)
			return redirect()->back()->withInput()->withErrors("We can't verify you as our customer.");


		$schema = $this->createSchema();
		$migrate = $this->migrate();
		//print_r($migrate);exit();
		$seed = $this->seedDB();

		try{
			DB::beginTransaction();
				///capitalize the first letter of the name for each word
			$capName = ucwords(strtolower('Admin'));
			
			$user = User::create([
				'name' => $data->result->comp_name,
				'email_ID' => $request->email_ID,
				'password' => bcrypt($request->password),
				'role_id' => 3,
				'profession' => 'Admin',
				'phone_num' => '999999999',
				'avatar' => 'default.jpg',
				'verifyToken' => Str::random(40),
				'plank_suggestion' =>'',
				'last_activity'	=>	date('Y-M-d H:i:s', time()),

			]);

			$s3 = \Storage::disk('s3');
			$image = $request->file('image');
			$imageFileName = time() . '.png';
			$path = 'public/uploads/tenant_' . $imageFileName;
			if($s3->put($path, file_get_contents($request->file('image')), 'public')){
				$user->logo = env('S3_URL').$path;
			}
			$user->save();


			RoleUser::insert([
				'role_id' => 3,
				'user_id' => $user->id,
			]);
			



			$thisUser = User::findorFail($user->id);
			$this->sendMail($thisUser);
			$update_tenant_status = $this->tenant_status_update($data->result->id);
			if($update_tenant_status == 204){
				throw new Exception("Not updated");
			}
			Session::flash('regstatus', 'Installation Procedure Successfull !  Please verify your mail id to Active your Account');
			DB::commit();
			return redirect('login');
	    }catch(\Exception $e){
	    	DB::rollBack();
	    	return $e->getMessage();
	    }
	}

	/**
	 * Creates a new database schema.

	 * 
	 * @return string
	 */
	function createSchema()
	{
		try{
			DB::beginTransaction();
			DB::statement('CREATE SCHEMA IF NOT EXISTS "Appeal"');
			DB::statement('CREATE SCHEMA IF NOT EXISTS "Propsal"');
			DB::statement('CREATE SCHEMA IF NOT EXISTS "Movement"');
			DB::statement('CREATE SCHEMA IF NOT EXISTS "User"');
	        DB::commit();
	        return 'Created';
	    }catch(\Exception $e){
	    	DB::rollBack();
	    	return $e->getMessage();
	    }
	}

	/**
	 * Migrate db files.

	 *
	 * @return string
	 */
	function migrate()
	{
		
		try{
			//echo '<br>init migrate:install...';
		      Artisan::call('migrate:install');
		      //echo 'done migrate:install';
			$migrate = Artisan::call('migrate', ['--force' => "true"] );
	        return $migrate;
	    }catch(\Exception $e){
	    	return $e->getMessage();
	    }
	}

	/**
	 * Seed DB with necessary data.

	 *
	 * @return string
	 */
	function seedDB()
	{
		try{
			DB::beginTransaction();
			$today = date("Y-m-d h:i:sa");

			///fill role table
			DB::table('User.roles')->insert([
			    ['id' => 1, 'name' => 'PrimarAdmin', 'display_name' => 'PrimarAdmin', 'description' => 'Primar Admin','created_at' => $today, 'updated_at' => NULL],
			    ['id' => 2, 'name' => 'SecondaryAdmin', 'display_name' => 'Secondary Admin', 'description' => 'Secondary Admin','created_at' => $today, 'updated_at' => NULL],
			    ['id' => 3, 'name' => 'TenantAdmin', 'display_name' => 'Tenant Admin', 'description' => 'Tenant Admin','created_at' => $today, 'updated_at' => NULL],
			    ['id' => 4, 'name' => 'LoggedinUser', 'display_name' => 'Logged in User', 'description' => 'Logged in User','created_at' => $today, 'updated_at' => NULL],
			]);

			//fill activity_type
			DB::table('public.activity_type')->insert([
				['id' => 1, 'name' => 'Appeal'],
				['id' => 2, 'name' => 'Movement'],
				['id' => 3, 'name' => 'Proposal'],
				['id' => 4, 'name' => 'Gratitude'],
				['id' => 5, 'name' => 'Resource not return'],
				['id' => 6, 'name' => 'User disable for 3 months'],
				['id' => 7, 'name' => 'User idle']
				]);
			
			//fill levels_catalogue
			DB::table('public.levels_catalogue')->insert([
				['level_id' => 1, 'level_name' => 'Influencial', 'start_points' => 5,'end_points' => 5],
				['level_id' => 2, 'level_name' => 'Pro', 'start_points' => 4, 'end_points' => 4.9],
				['level_id' => 3, 'level_name' => 'Intermediate', 'start_points' => 3, 'end_points' => 3.9],
				['level_id' => 4, 'level_name' => 'Curious', 'start_points' =>2, 'end_points' => 2.9],
				['level_id' => 5, 'level_name' => 'Beginner', 'start_points' => 1, 'end_points' => 1.9]
				]);

			//fill points_catalogue

			DB::table('public.points_catalogue')->insert([
				['points_id' => 2, 'activity' => 'User Publish an new appeal', 'points' => 0.005, 'code' => 'NAP'],
				['points_id' => 3, 'activity' => 'Appeal gets more then 100 Votes', 'points' => 0.005, 'code' => 'VAP100'],
				['points_id' => 4, 'activity' => 'Appeal gets more then 500 Votes', 'points' => 0.001, 'code' => 'VAP500'],
				['points_id' => 5, 'activity' => 'Appeal gets more then 2000 Votes or more', 'points' => 0.02, 'code' => 'VAP2000'],
				['points_id' => 6, 'activity' => 'Appeal/propose/movement gets more then 100 watchers', 'points' => 0.005, 'code' => 'WATC100'],
				['points_id' => 7, 'activity' => 'Appeal/propose/movement gets more then 500 Watchers', 'points' => 0.01, 'code' => 'WATC500'],
				['points_id' => 8, 'activity' => 'Appeal/propose/movement gets more then 2000 watchers or more', 'points' => 0.02, 'code' => 'WATC2000'],
				['points_id' => 9, 'activity' => 'Perform verification', 'points' => 0.01, 'code' => 'VARF'],
				['points_id' => 10, 'activity' => 'Gratitude sent', 'points' => 0.001, 'code' => 'GRTD'],
				['points_id' => 11, 'activity' => 'Funding palnnnck - Every 500', 'points' => 0.005, 'code' => 'FUND'],
				['points_id' => 12, 'activity' => 'Movement/session completion - Host (both Activity and Training )', 'points' => 0.005, 'code' => 'MCH'],
				['points_id' => 13, 'activity' => 'Movement/session completion - Co host', 'points' => 0.003, 'code' => 'MCCH'],
				['points_id' => 14, 'activity' => 'Movement/session completion - Participant (only when host acknowledges )', 'points' => 0.001, 'code' => 'MCCP'],
				['points_id' => 15, 'activity' => 'When participant’s collective duration hits pass 40 hrs a month', 'points' => 0.005, 'code' => 'DUR40'],
				['points_id' => 16, 'activity' => 'Making new proposal ( if approved )', 'points' => 0.05, 'code' => 'NEWP'],
				['points_id' => 17, 'activity' => 'Each inspired movement - the proposal author', 'points' => 0.01, 'code' => 'PRAU'],
				['points_id' => 18, 'activity' => 'Suggesting existing proposal', 'points' => 0.001, 'code' => 'PRSG'],
				['points_id' => 19, 'activity' => 'Each resource contributed', 'points' => 0.002, 'code' => 'RSCN'],
				['points_id' => 20, 'activity' => 'Conversation thread going to public - only for the seeker and not the author', 'points' => 0.001, 'code' => 'CNPB'],
				['points_id' => 21, 'activity' => 'if anybody start your movement elsewhere', 'points' => 0.0005, 'code' => 'MVCP'],
				['points_id' => 22, 'activity' => 'Being idle in the platform for 2 weeks', 'points' => -0.001, 'code' => 'IDLE'],
				['points_id' => 23, 'activity' => 'Your appeal reported and decided as inappropriate', 'points' => -0.001, 'code' => 'APRP'],
				['points_id' => 24, 'activity' => 'Your movement reported and decided as inappropriate', 'points' => -0.005, 'code' => 'MVRP'],
				['points_id' => 25, 'activity' => 'Calling off movement', 'points' => -0.005, 'code' => 'MVCF'],
				['points_id' => 26, 'activity' => 'Pull out of movement before 2 days of movement starting date', 'points' => -0.002, 'code' => 'MVPO'],
				['points_id' => 27, 'activity' => 'Host doesnt mark you as shown up for movement', 'points' => -0.0005, 'code' => 'NOSH'],
				['points_id' => 28, 'activity' => 'Dint provide resource as promised', 'points' => -0.0005, 'code' => 'NORS'],
				['points_id' => 29, 'activity' => 'Account suspension for 3 months', 'points' => -0.1, 'code' => 'ACSP'],
				['points_id' => 30, 'activity' => 'Appeal/propose/movement gets less then 99 watchers', 'points' => -0.005, 'code' => 'WATC99'],
				['points_id' => 31, 'activity' => 'Appeal/propose/movement gets less then 499 watchers', 'points' => -0.01, 'code' => 'WATC499'],
				['points_id' => 32, 'activity' => 'Appeal/propose/movement gets less then 1999 watchers', 'points' => -0.02, 'code' => 'WATC1999'],
				['points_id' => 33, 'activity' => 'Your proposal reported and decided as inappropriate', 'points' => -0.001, 'code' => 'PPRP']
			]);

			//fill categories
			DB::table('Appeal.categories')->insert([
				['id' => 1, 'cat_name' => 'All', 'cat_img' => 'all.jpg'],
				['id' => 2, 'cat_name' => 'Agriculture', 'cat_img' => 'agriculture.jpg'],
				['id' => 3, 'cat_name' => 'Animal', 'cat_img' => 'animals.jpg'],
				['id' => 4, 'cat_name' => 'Arts', 'cat_img' => 'arts.jpg'],
				['id' => 5, 'cat_name' => 'Arts & culture', 'cat_img' => 'culture.jpg'],
				['id' => 6, 'cat_name' => 'Awareness', 'cat_img' => 'awareness.jpg'],
				['id' => 7, 'cat_name' => 'Child', 'cat_img' => 'child.jpg'],
				['id' => 8, 'cat_name' => 'Climate change', 'cat_img' => 'climate-change.jpg'],
				['id' => 9, 'cat_name' => 'Compassion', 'cat_img' => 'compassion.jpg'],
				['id' => 10, 'cat_name' => 'Computers', 'cat_img' => 'computer.jpg'],
				['id' => 11, 'cat_name' => 'Disaster', 'cat_img' => 'disaster.jpg'],
				['id' => 12, 'cat_name' => 'Education', 'cat_img' => 'education.jpg'],
				['id' => 13, 'cat_name' => 'Energy', 'cat_img' => 'energy.jpg'],
				['id' => 14, 'cat_name' => 'Environment', 'cat_img' => 'environment.jpg'],
				['id' => 15, 'cat_name' => 'Family', 'cat_img' => 'family.jpg'],
				['id' => 16, 'cat_name' => 'Farming', 'cat_img' => 'farming.jpg'],
				['id' => 17, 'cat_name' => 'Food', 'cat_img' => 'food.jpg'],
				['id' => 18, 'cat_name' => 'Hackathon', 'cat_img' => 'hackathon.jpg'],
				['id' => 19, 'cat_name' => 'Healthcare', 'cat_img' => 'healthcare.jpg'],
				['id' => 20, 'cat_name' => 'Infrastructure', 'cat_img' => 'insfrastructure.jpg'],
				['id' => 21, 'cat_name' => 'Internship', 'cat_img' => 'internship.jpg'],
				['id' => 22, 'cat_name' =>'Kindness' , 'cat_img' => 'kindness.jpg'],
				['id' => 23, 'cat_name' => 'Peace', 'cat_img' => 'peace.jpg'],
				['id' => 24, 'cat_name' => 'Refugees', 'cat_img' => 'refugee.jpg'],
				['id' => 26, 'cat_name' => 'School', 'cat_img' => 'school.jpg'],
				['id' => 27, 'cat_name' => 'Science', 'cat_img' => 'science.jpg'],
				['id' => 28, 'cat_name' => 'Seniors', 'cat_img' => 'seniors.jpg'],
				['id' => 29, 'cat_name' => 'Sports', 'cat_img' => 'sports.jpg'],
				['id' => 30, 'cat_name' => 'Strategy', 'cat_img' => 'strategy.jpg'],
				['id' => 31, 'cat_name' => 'Suicide', 'cat_img' => 'suicide.jpg'],
				['id' => 32, 'cat_name' => 'Water', 'cat_img' => 'water.jpg'],
				['id' => 33, 'cat_name' => 'Women', 'cat_img' => 'women.jpg'],
				['id' => 34, 'cat_name' => 'Others', 'cat_img' => 'others.jpg'],
				]);

			///fill appeal status
			DB::table('Appeal.Appeal_status')->insert([
				['status_name' => 'appealcreated', 'id' => 1],
				['status_name' => 'drafts', 'id' => 2],
				['status_name' => '3rd party', 'id' => 3]
				]);



	        DB::commit();
	        return 'Created';
	    }catch(\Exception $e){
	    	DB::rollBack();
	    	return $e->getMessage();
	    }
	}

	public function sendMail($thisUser) {
		Mail::to($thisUser['email_ID'])->send(new verifyEmail($thisUser));
	}

	public function tenant_status_update($id){
		$url = env('APP_ENV_TYPE').env('APP_MAIN_DOMAIN')."/api/update/tenant/status?tenantId=".$id;
		$ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt( $ch,CURLOPT_POST, false );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	    $data = curl_exec($ch);
        if ($data === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
		curl_close( $ch );

		$data = json_decode($data);
		if($data)
			return $data->status;
		else
			return 202;
	}
}