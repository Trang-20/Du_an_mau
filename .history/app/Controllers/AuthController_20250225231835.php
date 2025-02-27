namespace App\Controllers;

use eftec\bladeone\BladeOne;

class AuthController {
    protected $blade;

    public function __construct(BladeOne $blade) {
        $this->blade = $blade;
    }

    public function showLoginForm() {
        echo $this->blade->run("auth.login"); // Nếu file nằm trong app/Views/auth/
    }
}
