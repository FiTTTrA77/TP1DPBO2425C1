
#include <iostream>
#include <string>
using namespace std;

class Elektronik{
private:
    int id;
    string nama;
    string merek;
    string harga;

 

public:
    //konstruktor 
    Elektronik() : id(0), nama(""), merek(""), harga("") {}

    //konstruktor dengan parameter
    Elektronik(int i, string n, string m, string h)
        : id(i), nama(n), merek(m), harga(h) {}

    //getter
    int getId()const{ 
        return id; 
    }
    string getNama() const{ 
        return nama; 
    }
    string getMerek() const{ 
        return merek; 
    }
    string getHarga() const{ 
        return harga; 
    }

    //setter
    void setId(int i){ 
        id = i; 
    }
    void setNama(string n){
        nama = n; 
    }
    void setMerek(string m){ 
        merek = m; 
    }
    void setHarga(string h){ 
        harga = h; 
    }



    //method tampil
    void tampil() const {
        cout << "ID: " << id << " | Nama: " << nama << " | Merek: " << merek << " | Harga: " << harga << endl;
    }
};


