public class Elektronik {
    private int id;
    private String nama;
    private String merk;
    private double harga;

    public Elektronik(int id, String nama, String merk, double harga) {
        this.id = id;
        this.nama = nama;
        this.merk = merk;
        this.harga = harga;
    }

    // Getter dan Setter
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getNama() { return nama; }
    public void setNama(String nama) { this.nama = nama; }

    public String getMerk() { return merk; }
    public void setMerk(String merk) { this.merk = merk; }

    public double getHarga() { return harga; }
    public void setHarga(double harga) { this.harga = harga; }

    // Method untuk menampilkan info
    public void tampilkan() {
        System.out.println("ID: " + id + ", Nama: " + nama + ", Merk: " + merk + ", Harga: " + harga);
    }
}
