  const prodiData = {
      hukum: ["S1 Ilmu Hukum"],
      ekonomi: ["S1 Manajemen", "S1 Akuntansi", "D3 Manajemen Perusahaan"],
      teknik: ["S1 Teknik Sipil", "S1 Teknik Elektro", "S1 Perencanaan Wilayah Dan Kota"],
      psikologi: ["S1 Psikologi"],
      ftp: ["S1 Teknologi Hasil Pertanian"],
      ftik: ["S1 Teknik Informatika", "S1 Sistem Informasi", "S1 Ilmu Komunikasi", "S1 Parawisata"]
  };

  const fakultasSelect = document.getElementById("fakultas");
  const prodiSelect = document.getElementById("prodi");

  fakultasSelect.addEventListener("change", function () {
    const selectedFakultas = this.value;
    const prodiList = prodiData[selectedFakultas] || [];

    prodiSelect.innerHTML = '<option disabled selected>-- Pilih Program Studi --</option>';

    prodiList.forEach(prd => {
      const option = document.createElement("option");
      option.value = prd;
      option.textContent = prd;
      prodiSelect.appendChild(option);
    });
  });