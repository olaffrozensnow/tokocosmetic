<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'orderID';
    protected $allowedFields = ['userID', 'alamatID', 'TanggalOrder', 'TotalHarga', 'StatusOrder'];

    public function getAllOrders()
    {
        return $this->db->query("
            SELECT DISTINCT
                o.orderID,
                p.UserName AS Nama_Pelanggan,
                CONCAT(a.Jalan, ', ', a.Kota, ', ', a.Provinsi, ' ', a.KodePos) AS Alamat_Pengiriman,
                o.TanggalOrder,
                o.TotalHarga,
                o.StatusOrder,
                pb.metodePembayaran
            FROM `order` o
            LEFT JOIN pengguna p ON o.userID = p.UserID
            LEFT JOIN alamat a ON o.alamatID = a.alamatID
            LEFT JOIN pembayaran pb ON o.orderID = pb.orderID
            ORDER BY o.TanggalOrder DESC
        ")->getResultArray();
    }

    public function getOrderInfo($orderID)
    {
        return $this->db->query("
            SELECT 
                o.orderID,
                p.UserName AS Nama_Pelanggan,
                o.TanggalOrder,
                o.TotalHarga,
                o.StatusOrder,
                pb.metodePembayaran
            FROM `order` o
            LEFT JOIN pengguna p ON o.userID = p.UserID
            LEFT JOIN pembayaran pb ON o.orderID = pb.orderID
            WHERE o.orderID = ?
            LIMIT 1
        ", [$orderID])->getRowArray();
    }

    public function getOrderDetail($orderID)
    {
        return $this->db->query("
            SELECT 
                d.productID,
                pr.productName,
                d.jumlahItem,
                d.Harga,
                (d.Harga * d.jumlahItem) AS Subtotal
            FROM detailorder d
            LEFT JOIN product pr ON d.productID = pr.productID
            WHERE d.orderID = ?
        ", [$orderID])->getResultArray();
    }
}