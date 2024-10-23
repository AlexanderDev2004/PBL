
class UserController extends Controller {
    public function login() {
        $this->view('user/login');
    }

    public function profile($id) {
        $user = $this->model('User')->find($id);
        $this->view('user/profile', ['user' => $user]);
    }
}
