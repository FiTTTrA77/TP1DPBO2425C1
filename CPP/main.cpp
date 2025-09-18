#include <iostream>
#include <vector>
#include "Elektronik.cpp"
using namespace std;

//verktor untuk menyimpan daftar barang elektronik 
vector<Elektronik>daftar;

//mencari indesx barang berdasarkan id
int cariIndexById(int id) {
    for(int i = 0; i < (int)daftar.size(); i++){
        if (daftar[i].getId() == id)
        return i;
    }
    return -1;
}

//menambahkan data barang baru
void tambahData(){
    int id; string nama, merek; double harga;

    cout << "Masukkan ID: "; cin >> id;

    //mengecek apakah id sudah ada
    if (cariIndexById(id) != -1) {
        cout << "ID sudah ada!\n";
        return;
    }

    cout << "Masukkan Nama: "; cin >> nama;
    cout << "Masukkan Merek: "; cin >> merek;
    cout << "Masukkan Harga: "; cin >> harga;

    //buat objek elektronik dan simpan ke vektor
    Elektronik e;
    e.setId(id);
    e.setNama(nama);
    e.setMerek(merek);
    e.setHarga(harga);

    daftar.push_back(e);
    cout << "Data berhasil ditambahkan!\n";
}

//menampilkan semua data barang
void tampilData(){
    if (daftar.empty()){
        cout << "Belum ada data.\n";
        return;
    }
    for (const auto &e : daftar){
        //panggil method tampil setiap barang
        e.tampil();
    }
}

//mengupdate data berdasarkan id
void updateData(){
    int id; 
    cout << "Masukkan ID yang ingin diupdate: "; cin >> id;

    int index = cariIndexById(id);
    if (index == -1) {
        cout << "Data tidak ditemukan.\n";
        return;
    }

    string nama, merek; double harga;
    cout << "Masukkan Nama baru: "; cin >> nama;
    cout << "Masukkan Merek baru: "; cin >> merek;
    cout << "Masukkan Harga baru: "; cin >> harga;

    
    daftar[index].setNama(nama);
    daftar[index].setMerek(merek);
    daftar[index].setHarga(harga);

    cout << "Data berhasil diupdate!\n";
}

//menghapuskan data berdasarkan id
void hapusData(){
    int id; 
    cout << "Masukkan ID yang ingin dihapus: "; cin >> id;
    int index = cariIndexById(id);
    if (index == -1) {
        cout << "Data tidak ditemukan.\n";
        return;
    }
    daftar.erase(daftar.begin() + index);
    cout << "Data berhasil dihapus!\n";
}

//mencari dan menampilkan data berdasarkan id
void cariData(){
    int id; 
    cout << "Masukkan ID yang dicari: "; cin >> id;
    int index = cariIndexById(id);
    if (index == -1) {
        cout << "Data tidak ditemukan\n";
        return;
    }
    //tampilkan saat ditemukan
    daftar[index].tampil();
}

int main(){
    int pilihan;
    do{
        cout << "\n=== Menu Toko Elektronik ===\n";
        cout << "1. Tambah Data\n";
        cout << "2. Tampilkan Data\n";
        cout << "3. Update Data\n";
        cout << "4. Hapus Data\n";
        cout << "5. Cari Data\n";
        cout << "0. Keluar\n";
        cout << "Pilih: ";
        cin >> pilihan;

        switch (pilihan){
            case 1: tambahData(); 
            break;
            case 2: tampilData(); 
            break;
            case 3: updateData(); 
            break;
            case 4: hapusData(); 
            break;
            case 5: cariData(); 
            break;
            case 0: cout << "Hati Hati diJalan\n"; 
            break;
            default: cout << "Benerin, Masih Salah\n";
        }
    }
    while (pilihan != 0);

    return 0;
}
