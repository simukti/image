###DESKRIPSI###

Ini percobaan saya untuk menggunakan PHPThumb class dalam Zend Framework 1.11.x. 
Contoh aplikasi simpel ini akan melakukan resizing terhadap gambar yang telah sukses di-upload melalui Zend_Form, 
urutannya adalah sebagai berikut:

    * Hanya 1 gambar yang diupload dengan mime type image/jpg atau image/jpeg dan ekstensi .jpg
    * Setelah gambar tersebut valid, akan diupload folder public/image dan di-rename
    * Dari hasil upload tersebut, akan diambil absolute-path-nya
    * Absolute path gambar tersebut akan diproses oleh PHPThumb, dan akan disimpan dengan sama dengan folder tersebut dengan nama file berawalan _thumb_
    * Nama title dan file gambar tersebut (original dan hasil resize) akan disimpan dalam database sqlite
    * Untuk selanjutnya gambar yang ditampilkan dalam /index/list

##PERSYARATAN###

    * [Zend Framework](http://framework.zend.com/download/latest) (Saya memakai versi 1.11.10)
    * [PHPThumb](https://github.com/masterexploder/PHPThumb)
    * [php_gd](http://www.php.net/manual/en/image.installation.php)

###CATATAN###

    * Saya asumsikan folder `public/image/` rewritable
    * Filesize gambar tidak lebih dari 1Mb (atau anda bisa ganti di class Application_Form_Photo)
    * Saya tidak memakai modular setup dan service layer
    * Tidak ada error handling pada data yang duplikat di sqlite
    * Tidak ada css/js styling :p