class Elektronik:
    def __init__(self, id, nama, merk, harga):
        self.__id = id
        self.__nama = nama
        self.__merk = merk
        self.__harga = harga

    # Getter & Setter
    def get_id(self): return self.__id
    def set_id(self, id): self.__id = id

    def get_nama(self): return self.__nama
    def set_nama(self, nama): self.__nama = nama

    def get_merk(self): return self.__merk
    def set_merk(self, merk): self.__merk = merk

    def get_harga(self): return self.__harga
    def set_harga(self, harga): self.__harga = harga

    def tampilkan(self):
        print(f"ID: {self.__id}, Nama: {self.__nama}, Merk: {self.__merk}, Harga: {self.__harga}")
