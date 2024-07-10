<?php namespace App\Controllers;

use App\Models\M_user;
use App\Models\Kursus_model;   
class Login extends BaseController
{
        public function product()
    {
        return view('product_view');
    }

	public function index()
	{
		return view('user_form');
   }
   
    public function login_action() 
    {
        $muser = new User();
            
        $role = $this->request->getPost('role');
        // $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $cek = $muser->get_data($role, $password);

        if ($cek !== null && isset($cek['role']) && isset($cek['user_pass'])) {
            if ($cek['role'] == $role && $cek['user_pass'] == $password) {
                if($cek['role'] == 'admin'){
                    session()->set('role', $cek['role']);
                    session()->set('user_pass', $cek['user_pass']);

                    $model = new Kursus_model();
                    $data['kursus'] = $model->getKursus();
                    echo view('kursus_view', $data); // Arahkan ke halaman /login/product
                }elseif($cek['role'] == 'peserta'){
                    echo view('peserta_form');
                }
            } else {
                session()->setFlashdata('gagal', 'Username / Password salah');
                echo view('user_form');
            }
        }
    }
   
   public function logout() 
   {
      session()->destroy();
      return redirect()->to(base_url('login'));
   }

	//--------------------------------------------------------------------

}