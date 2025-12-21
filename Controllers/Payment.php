<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\CartItemModel;
use App\Models\PenggunaModel;
use App\Models\AlamatModel;

class Payment extends Controller
{
    private $db;

    public function __construct()
    {
         
        Config::$serverKey = getenv('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; 
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $this->db = \Config\Database::connect();
    }

    public function checkout()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }

        $session = session();
        $userID = $session->get('UserID');

        if (!$userID) {
            return $this->response->setJSON(['error' => 'Silakan login untuk melanjutkan.'])->setStatusCode(401);
        }

        $body = json_decode($this->request->getBody());
        $selectedCartItemIDs = $body->cart_item_ids ?? [];

        if (empty($selectedCartItemIDs)) {
            return $this->response->setJSON(['error' => 'Tidak ada item yang dipilih untuk checkout.'])->setStatusCode(400);
        }

        $penggunaModel = new PenggunaModel();
        $user = $penggunaModel->find($userID);
        
        $alamatModel = new AlamatModel();
        $alamat = $alamatModel->where('UserID', $userID)->first();

        if (!$user || !$alamat) {
            return $this->response->setJSON(['error' => 'Data pengguna atau alamat tidak lengkap.'])->setStatusCode(404);
        }

        $cartItemModel = new CartItemModel();
        $cartItems = $cartItemModel->getSelectedCartItems($userID, $selectedCartItemIDs);

        if (empty($cartItems)) {
            return $this->response->setJSON(['error' => 'Item yang dipilih tidak ditemukan di keranjang.'])->setStatusCode(400);
        }

        $gross_amount = 0;
        $item_details = [];
        foreach ($cartItems as $item) {
            $gross_amount += $item['Harga'] * $item['Quantity'];
            $item_details[] = [
                'id'       => $item['productID'],
                'price'    => (int) $item['Harga'],
                'quantity' => (int) $item['Quantity'],
                'name'     => $item['productName'],
            ];
        }

        $orderID = 'ODR-' . strtoupper(uniqid(mt_rand(), true));

        $transaction_details = [
            'order_id'     => $orderID,
            'gross_amount' => $gross_amount,
        ];
        
        $customer_details = [
            'first_name' => $user['UserName'],
            'email'      => $user['Email'],
            'phone'      => $user['noHP'],
        ];

        $session->set('pending_order_data', [
            'orderID'    => $orderID,
            'userID'     => $userID,
            'alamatID'   => $alamat['alamatID'],
            'totalHarga' => $gross_amount,
            'cartItems'  => $cartItems,
        ]);

        $params = [
            'transaction_details' => $transaction_details,
            'item_details'        => $item_details,
            'customer_details'    => $customer_details,
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return $this->response->setJSON(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            log_message('error', 'Midtrans Token Creation Failed: ' . $e->getMessage());
            return $this->response->setJSON(['error' => 'Gagal membuat token pembayaran. Silakan coba lagi.'])->setStatusCode(500);
        }
    }
    
    public function saveOrder()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403, 'Forbidden');
        }
        
        $session = session();
        $paymentResult = json_decode($this->request->getBody(), true);
        $orderID = $paymentResult['order_id'] ?? null;

        if (!$orderID) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Order ID tidak valid.'])->setStatusCode(400);
        }

        $statusOrder = 'Gagal';
        $transactionStatus = $paymentResult['transaction_status'] ?? 'gagal';
        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            $statusOrder = 'Sukses';
        } elseif ($transactionStatus == 'pending') {
            $statusOrder = 'Menunggu Pembayaran';
        }
        
        $existingOrder = $this->db->table('order')->where('orderID', $orderID)->get()->getRow();

        $this->db->transStart();

        try {
            if ($existingOrder) {
                $this->db->table('order')->where('orderID', $orderID)->update([
                    'StatusOrder' => $statusOrder,
                ]);

                $this->db->table('pembayaran')->where('orderID', $orderID)->update([
                    'metodePembayaran' => $paymentResult['payment_type'],
                ]);
            } else {
                $pendingOrderData = $session->get('pending_order_data');
                
                if (!$pendingOrderData || $orderID !== $pendingOrderData['orderID']) {
                    $this->db->transRollback();
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Sesi pesanan tidak valid atau telah berakhir.'])->setStatusCode(400);
                }

                $this->db->table('order')->insert([
                    'orderID'      => $pendingOrderData['orderID'],
                    'userID'       => $pendingOrderData['userID'],
                    'alamatID'     => $pendingOrderData['alamatID'],
                    'TanggalOrder' => date('Y-m-d H:i:s'),
                    'TotalHarga'   => $pendingOrderData['totalHarga'],
                    'StatusOrder'  => $statusOrder,
                ]);

                $detailOrderData = [];
                $productUpdates = [];
                foreach ($pendingOrderData['cartItems'] as $item) {
                    $detailOrderData[] = [
                        'detailOrderID' => 'DET-' . strtoupper(uniqid(mt_rand(), true)), // FIX 
                        'productID'     => $item['productID'],
                        'orderID'       => $pendingOrderData['orderID'],
                        'Harga'         => $item['Harga'],
                        'jumlahItem'    => $item['Quantity'],
                    ];
                    
                    if ($statusOrder === 'Sukses') {
                        $productUpdates[] = [
                            'productID' => $item['productID'],
                            'quantity'  => $item['Quantity']
                        ];
                    }
                }
                $this->db->table('detailorder')->insertBatch($detailOrderData);

                if (!empty($productUpdates)) {
                    foreach ($productUpdates as $update) {
                        $this->db->query("UPDATE product SET Stok = Stok - ? WHERE productID = ?", [
                            $update['quantity'], 
                            $update['productID']
                        ]);
                    }
                    log_message('info', 'Stok produk berhasil dikurangi untuk Order ID: ' . $orderID);
                }

                $this->db->table('pembayaran')->insert([
                    'pembayaranID'     => 'PAY-' . strtoupper(uniqid(mt_rand(), true)), // FIX 
                    'orderID'          => $pendingOrderData['orderID'],
                    'metodePembayaran' => $paymentResult['payment_type'],
                ]);
                
                $cartItemIDsToRemove = array_column($pendingOrderData['cartItems'], 'cartitemID');
                if (!empty($cartItemIDsToRemove)) {
                    $cartItemModel = new CartItemModel();
                    $cartItemModel->whereIn('cartitemID', $cartItemIDsToRemove)->delete();
                }

                $session->remove('pending_order_data');
            }
            
            $this->db->transComplete();
            
            if ($this->db->transStatus() === false) {
                $dbError = $this->db->error();
                log_message('error', 'Database transaction failed while saving order: ' . $orderID . ' DB Error: ' . json_encode($dbError));
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan pesanan ke database. Silakan periksa log.']);
            }

        } catch (\Exception $e) {
            $this->db->transRollback();
            log_message('error', 'Exception during saveOrder: ' . $e->getMessage());
            return $this->response->setJSON(['status' => 'error', 'message' => 'Terjadi kesalahan sistem saat menyimpan pesanan.']);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Pesanan berhasil diproses.']);
    }

    public function notificationHandler()
    {
        try {
            $rawNotification = file_get_contents('php://input');
            $notif = new Notification();

            $orderId = $notif->order_id;
            $transactionStatus = $notif->transaction_status;
            $fraudStatus = $notif->fraud_status ?? '';

            log_message('info', "Midtrans Notification Received for Order ID: {$orderId}. Status: {$transactionStatus}, Fraud Status: {$fraudStatus}");

            $existingOrder = $this->db->table('order')->where('orderID', $orderId)->get()->getRow();
            
            if (!$existingOrder) {
                log_message('warning', "Order {$orderId} not found in database. Notification may have arrived before order creation.");
                return $this->response->setStatusCode(200, 'Order not found but acknowledged');
            }

            $statusOrder = '';

            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $statusOrder = 'Sukses';
                } else if ($fraudStatus == 'challenge') {
                    $statusOrder = 'Menunggu Verifikasi';
                } else if ($fraudStatus == 'deny') {
                    $statusOrder = 'Gagal';
                }
            } else if ($transactionStatus == 'settlement') {
                $statusOrder = 'Sukses';
            } else if ($transactionStatus == 'pending') {
                $statusOrder = 'Menunggu Pembayaran';
            } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $statusOrder = 'Gagal';
            } else if ($transactionStatus == 'refund') {
                $statusOrder = 'Refund';
            } else if ($transactionStatus == 'partial_refund') {
                $statusOrder = 'Refund Sebagian';
            }

            if (!empty($statusOrder)) {
                $updateResult = $this->db->table('order')
                                         ->where('orderID', $orderId)
                                         ->update(['StatusOrder' => $statusOrder]);
                
                if ($updateResult) {
                    log_message('info', "Order {$orderId} status updated to {$statusOrder}.");
                } else {
                    log_message('error', "Failed to update order {$orderId} status to {$statusOrder}.");
                }
            } else {
                log_message('warning', "Unknown transaction status '{$transactionStatus}' for order {$orderId}");
            }

            return $this->response->setStatusCode(200, 'OK');

        } catch (\Exception $e) {
            log_message('error', 'Midtrans Notification Error: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            if (strpos($e->getMessage(), '404') !== false || strpos($e->getMessage(), "Transaction doesn't exist") !== false) {
                log_message('warning', 'Transaction not found in Midtrans. This may be a test notification or environment mismatch.');
                return $this->response->setStatusCode(200, 'Transaction not found but acknowledged');
            }
            
            return $this->response->setStatusCode(500, 'Internal Server Error');
        }
    }

    public function testWebhook()
    {
        log_message('info', 'Webhook test endpoint accessed');
        
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Webhook endpoint is working',
            'timestamp' => date('Y-m-d H:i:s'),
            'environment' => Config::$isProduction ? 'production' : 'sandbox'
        ]);
    }
}