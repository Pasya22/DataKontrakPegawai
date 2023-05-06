CREATE TABLE jabatan (
  id_jabatan INT PRIMARY KEY AUTO_INCREMENT,
  jabatan VARCHAR(50),
  gaji DECIMAL(10,2)
);

CREATE TABLE pegawai (
  id_pegawai INT PRIMARY KEY AUTO_INCREMENT,
  nama VARCHAR(50),
  tanggal_lahir DATE,
  jenis_kelamin VARCHAR(10)
);

CREATE TABLE kontrak (
  id_kontrak INT PRIMARY KEY AUTO_INCREMENT,
  id_pegawai INT,
  id_jabatan INT,
  tanggal_mulai DATE,
  tanggal_selesai DATE,
  FOREIGN KEY (id_pegawai) REFERENCES pegawai(id_pegawai),
  FOREIGN KEY (id_jabatan) REFERENCES jabatan(id_jabatan)
);
