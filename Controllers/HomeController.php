<?php
class HomeController extends Controller {
    public function index() {
        $urlModel = $this->model('Url');
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inputUrl = trim($_POST['url']);
            $pattern = '/\bhttps?:\/\/[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|\/))/i';

            if (!preg_match($pattern, $inputUrl)) {
                $message = 'Geçerli bir URL giriniz.';
            } else {
                $found = $urlModel->findByOriginal($inputUrl);
                if ($found) {
                    $short = $found['short_code'];
                    $message = 'Zaten kayıtlı: ' . BASE_URL . '?r=' . $short;
                } else {
                    $short = $urlModel->generateKey();
                    $urlModel->save($inputUrl, $short);
                    $message = 'Yeni kısaltma: ' . BASE_URL . '?r=' . $short;
                }
            }
        }

        if (isset($_GET['r'])) {
            $result = $urlModel->findByShort($_GET['r']);
            if ($result) {
                header("Location: " . $result['original_url']);
                exit;
            } else {
                $message = 'Kısaltma bulunamadı.';
            }
        }

        $this->view('home', ['message' => $message]);
    }
}
