from elektronik import Elektronik

daftar = []

#menambahkan suatu adata
def tambah():
    id = int(input("ID: "))
    nama = input("Nama: ")
    merk = input("Merk: ")
    harga = float(input("Harga: "))
    daftar.append(Elektronik(id, nama, merk, harga))

#menampilkan
def tampilkan():
    for e in daftar:
        e.tampilkan()
#update data
def update():
    id = int(input("ID yang ingin diupdate: "))
    for e in daftar:
        if e.get_id() == id:
            e.set_nama(input("Nama baru: "))
            e.set_merk(input("Merk baru: "))
            e.set_harga(float(input("Harga baru: ")))
            return
    print("Data tidak ditemukan.")

#menghapus data
def hapus():
    id = int(input("ID yang ingin dihapus: "))
    global daftar
    daftar = [e for e in daftar if e.get_id() != id]

#mencari data
def cari():
    id = int(input("ID yang dicari: "))
    for e in daftar:
        if e.get_id() == id:
            e.tampilkan()
            return
    print("Data tidak ditemukan.")

def main():
    while True:
        print("\n=== MENU TOKO ELEKTRONIK ===")
        print("1. Tambah Data")
        print("2. Tampilkan Data")
        print("3. Update Data")
        print("4. Hapus Data")
        print("5. Cari Data")
        print("0. Keluar")
        pilih = input("Pilih: ")

        if pilih == "1": tambah()
        elif pilih == "2": tampilkan()
        elif pilih == "3": update()
        elif pilih == "4": hapus()
        elif pilih == "5": cari()
        elif pilih == "0": break

if __name__ == "__main__":
    main()
