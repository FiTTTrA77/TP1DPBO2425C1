<?php
class elektronik {
    private $id;
    private $nama;
    private $merek;
    private $harga;
    private $gambar; // ← tambahkan atribut ini

    public function __construct($id, $nama, $merek, $harga, $gambar = '') {
        $this->id = $id;
        $this->nama = $nama;
        $this->merek = $merek;
        $this->harga = $harga;
        $this->gambar = $gambar;
    }

    // --- Getter ---
    public function getId()    { return $this->id; }
    public function getNama()  { return $this->nama; }
    public function getMerek() { return $this->merek; }
    public function getHarga() { return $this->harga; }
    public function getGambar(){ return $this->gambar; }

    // --- Setter ---
    public function setNama($nama)    { $this->nama = $nama; }
    public function setMerek($merek)  { $this->merek = $merek; }
    public function setHarga($harga)  { $this->harga = $harga; }
    public function setGambar($gambar){ $this->gambar = $gambar; }

    public function tampil() {
        echo "<p>ID: {$this->id}, Nama: {$this->nama}, Merek: {$this->merek}, Harga: {$this->harga}</p>";
        if (!empty($this->gambar)) {
            echo "<img src='{$this->gambar}' width='100'>";
        }
    }
}
?>
