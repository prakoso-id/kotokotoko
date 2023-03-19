<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PayProcess extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        include APPPATH . 'third_party/midtrans-master/Midtrans.php';
        //Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'Mid-server-hwdhaGr7iFHIXqr-7qrmU1no'; // production
        // \Midtrans\Config::$serverKey = 'SB-Mid-server-h93vwb-wqqxCYsiIjIGY1TT2'; // sandbox
        //Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // \Midtrans\Config::$isProduction = false; // sandbox
        \Midtrans\Config::$isProduction = true; // production
        // \Midtrans\Config::$isProduction = false;
        //Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        //Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        // Konfigurasi email
        $this->load->library('email');
        $this->email->initialize([
            'protocol' => 'smtp',
            'smtp_host' => 'zmsmtp.tangerangkota.go.id',
            'smtp_user' => 'tangeranglive@tangerangkota.go.id',
            // 'smtp_user' => 'baznaskota.tangerang@baznas.go.id',
            'smtp_pass' => 'TangerangAyo321',
            // 'smtp_pass' => '8MYAHMADYANI',
            'smtp_port' => 587,
            'smtp_crypto' => 'tls',
            'mailtype' => 'html'
        ]);
        $this->email->set_newline("\r\n");
    }
    public function processPay()
    {
        $result = [];
        try {
            $nominal_zakat = str_replace('.', '', $this->input->post('f_nominal_zakat'));
            $transaction_details = array(
                'order_id'      => $this->get_uuid(),
                'gross_amount'  => $nominal_zakat,
            );
            $firstName = $this->splitName($this->input->post('f_name_zakat'));
            $customer_details = array(
                'first_name'    => $firstName[0],
                'last_name'     => count($firstName) > 1 ? $firstName[1] : "",
                'email'         => $this->input->post('f_email_zakat'),
                'phone'         => $this->input->post('f_telp_zakat')
            );
            //$enable_payments = array("wtf");
            $enable_payments = $this->input->post('f_paymethod');
            $transaction = array(
                'enabled_payments' => $enable_payments,
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
            );
            $snapToken = \Midtrans\Snap::getSnapToken($transaction);
            //$snapToken = "";
            $result = [
                'success'   => TRUE,
                'snapToken' => $snapToken,
                'message'   => '',
            ];
        } catch (Exception $e) {
            $result = [
                'success'   => FALSE,
                'snapToken' => '',
                'message'   => $e->getMessage(),
            ];
        }
        echo json_encode($result);
    }
    public function processFinishPay()
    {
        try {
            $this->load->model('admin/Transactionmidtrans_model', 'transactionMidtrans');
            $result = json_decode($this->input->post('result-json'), true);
            $resultJson = $this->input->post('result-json');
            $pdf_url = "";
            $MsgIntruksi = "";
            if ($result["payment_type"] == "gopay" || $result["payment_type"] == 'qris') {
                $pdf_url = "";
                $MsgIntruksi = "";
            } else {
                $pdf_url = $result["pdf_url"];
                $MsgIntruksi = "Panduan Pembayaran <a href=" . $pdf_url . ">Lihat</a>";
            }
            $data = array(
                'nik'                   => $this->input->post('f_nik'),
                'name'                  => $this->input->post('f_name'),
                'phone'                 => $this->input->post('f_telephone'),
                'email'                 => $this->input->post('f_email'),
                'jenis_zakat'           => $this->input->post('f_jenis_zakat'),
                'transaction_id'        => $result["transaction_id"],
                'order_id'              => $result["order_id"],
                'gross_amount'          => $result["gross_amount"],
                'payment_type'          => $result["payment_type"],
                'transaction_time'      => $result["transaction_time"],
                'transaction_status'    => $result["transaction_status"],
                'status_message'        => $result["status_message"],
                'link_intruction_pdf'   => $pdf_url,
                'response_json'         => $resultJson,
                'created_at'            => date('Y-m-d H:i:s'),
                'sumber'                => 'web'
            );
            $id = $this->transactionMidtrans->insert_data($data);
            // send email customer dengan $this->input->post('f_email')
            //     //get user inputs
            $email          = $this->input->post('f_email');
            $jenis_zakat    = $this->input->post('f_jenis_zakat');
            $nama           = $this->input->post('f_name');
            $id_order       = $result["order_id"];
            $status         = $result["transaction_status"];
            $pdf_url        = $this->input->post('link_intruction_pdf');
            // Email dan nama pengirim
            $this->email->from('tangeranglive@tangerangkota.go.id', 'Admin');
            // $this->email->from('baznaskota.tangerang@baznas.go.id', 'Admin');
            $this->email->to($email);
            $this->email->subject('Lakukan pembayaran ' . $jenis_zakat);
            $msg = '<p style="text-align: justify; color:#000;font-weight:400">
                        Lakukan pembayaran sebelum batas yang di tentukan berikut link cara pembayaran ' . $pdf_url . '
                      </p>';
            $this->email->message('
              <html><head><title>Transaksi anda berhasil</title></head><body>
              <style type="text/css">
              h3 {
                   font-family:HelveticaNeue-Light,arial,sans-serif; font-size:16px; line-height: 30px; font-weight:bold;margin:0; padding:0
              }
              </style>
              <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 30px;">
              <tbody>
              <td>
              <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
              <td bgcolor="#d1facd" style="padding: 8px; color: #fff; text-align: center;">
              <img src="https://service-tlive.tangerangkota.go.id/assets/tlive/tlive_logo.png" style="width: 360px; margin-bottom: 3px;">
              <h3 style="color:black;">BAZNAS Kota Tangerang</h3>
              </td>
              </tr>
              <tr>
              <td bgcolor="#ffffff" style="padding: 10px">
              <p style="text-align: justify; color:#000;font-weight:400">
              Hai <b>' . ucfirst(strtolower($nama)) . '</b>, Terima kasih sudah menggunakan BAZNAS Kota Tangerang, pembayaran <b>' . $jenis_zakat . '</b> dengan id order <b>' . $id_order . ' </b> saat ini status pembayaran <b>' . $status . '
              </p>
              ' . $MsgIntruksi . '
              <p style="text-align: justify; color:#000;font-weight:400">
              Demikian disampaikan, atas perhatian Bapak/Ibu kami ucapkan terima kasih.
              </p>
              <p style="color:#000;font-weight:400;margin:0">
              Salam, 
              </p>
              <p style="color:#000;font-weight:400;margin:0">
              BAZNAS Kota Tangerang
              </p>
              </td>
              </tr>
              </table>
              </td>
              </tbody>
              </table>
              </body>
              </html>     
              ');
            $this->email->set_mailtype('html');
            if ($this->email->send()) {
                $this->session->set_flashdata(
                    'msgSuccess',
                    '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Terimakasih!</strong> Status pembayaran anda saat ini <strong>' . $result["transaction_status"] . '</strong>.
                    <br />
                    ' . $MsgIntruksi . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
                );
            } else {
                $this->session->set_flashdata(
                    'msgSuccess',
                    '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Mohon Maaf Terjadi Kesalahan saat transaksi mohon coba beberapa saat lagi. Terimakasih.</strong> 
                    <br />
                    ' . $msg . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
                );
            }
            $this->session->set_flashdata(
                'msgSuccess',
                '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Terimakasih!</strong> Status pembayaran anda saat ini <strong>' . $result["transaction_status"] . '</strong>.
                <br />
                ' . $MsgIntruksi . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>'
            );
        } catch (Exception $e) {
            $this->session->set_flashdata(
                'msgSuccess',
                '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Mohon Maaf Terjadi Kesalahan saat transaksi mohon coba beberapa saat lagi. Terimakasih.</strong> 
                <br />
                ' . $e->getMessage() . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>'
            );
        }
        redirect($this->input->post('f_redirect'));
    }
    public function splitName($name)
    {
        $name = trim($name);
        $name = explode(' ', $name);
        $first_name = $name[0];
        unset($name[0]);
        $last_name = implode(' ', $name);
        return array($first_name, $last_name);
    }
    /**
     * generate uuid
     */
    public function get_uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
