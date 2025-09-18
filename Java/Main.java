import java.util.ArrayList;
import java.util.Scanner;

public class Main {
    static ArrayList<Elektronik> daftar = new ArrayList<>();
    static Scanner sc = new Scanner(System.in);

    public static void main(String[] args) {
        int pilih;
        do {
            System.out.println("\n=== MENU TOKO ELEKTRONIK ===");
            System.out.println("1. Tambah Data");
            System.out.println("2. Tampilkan Data");
            System.out.println("3. Update Data");
            System.out.println("4. Hapus Data");
            System.out.println("5. Cari Data");
            System.out.println("0. Keluar");
            System.out.print("Pilih: ");
            pilih = sc.nextInt();

            switch (pilih) {
                case 1 -> tambah();
                case 2 -> tampilkan();
                case 3 -> update();
                case 4 -> hapus();
                case 5 -> cari();
            }
        } while (pilih != 0);
    }

    static void tambah() {
        System.out.print("ID: ");
        int id = sc.nextInt(); sc.nextLine();
        System.out.print("Nama: ");
        String nama = sc.nextLine();
        System.out.print("Merk: ");
        String merk = sc.nextLine();
        System.out.print("Harga: ");
        double harga = sc.nextDouble();
        daftar.add(new Elektronik(id, nama, merk, harga));
    }

    static void tampilkan() {
        for (Elektronik e : daftar) e.tampilkan();
    }

    static void update() {
        System.out.print("Masukkan ID yang ingin diupdate: ");
        int id = sc.nextInt(); sc.nextLine();
        for (Elektronik e : daftar) {
            if (e.getId() == id) {
                System.out.print("Nama baru: ");
                e.setNama(sc.nextLine());
                System.out.print("Merk baru: ");
                e.setMerk(sc.nextLine());
                System.out.print("Harga baru: ");
                e.setHarga(sc.nextDouble());
                return;
            }
        }
        System.out.println("Data tidak ditemukan.");
    }

    static void hapus() {
        System.out.print("Masukkan ID yang ingin dihapus: ");
        int id = sc.nextInt();
        daftar.removeIf(e -> e.getId() == id);
    }

    static void cari() {
        System.out.print("Masukkan ID yang dicari: ");
        int id = sc.nextInt();
        for (Elektronik e : daftar) {
            if (e.getId() == id) {
                e.tampilkan();
                return;
            }
        }
        System.out.println("Data tidak ditemukan.");
    }
}
