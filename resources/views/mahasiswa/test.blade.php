<main class="d-flex align-items-center">
    <div class="container">
        <h1>Form Pengajuan PKL</h1>
        <form method="POST" action="#" enctype="multipart/form-data">
            <div id="wizard">

                <h3>Step 1 Title</h3>
                <section>
                    <h5 class="bd-wizard-step-title">Langkah 1</h5>
                    <h2 class="section-heading">Data Umum Pengajuan PKL</h2>
                    <div class="form-group">
                        <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name">
                    </div>

                    <div class="form-group">
                        <select id="bidang" name="bidang" class="custom-select" style="height: 60px;">
                            <option selected disabled hidden>Pilih Bidang</option>
                            <option value="bidang 1">Bidang Infrastruktur</option>
                            <option value="bidang 2">Bidang Datar</option>
                            <option value="bidang 3">Bidang</option>
                            <option value="bidang 4">Bidang</option>
                            <option value="bidang 5">Bidang</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="js-example-placeholder-multiple js-states form-control" name="states[]" multiple="multiple" style="width: 100%;">
                            <option value="AL">HTML</option>
                            <option value="WY">CSS</option>
                            <option value="WY">Javascript</option>
                            <option value="WY">React JS</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" placeholder="Tanggal Mulai PKL">
                    </div>

                    <div class="form-group">
                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" placeholder="Tanggal Selesai PKL">
                    </div>
                </section>

                <h3>Step 2 Title</h3>
                <section>
                    <h5 class="bd-wizard-step-title">Langkah 2</h5>
                    <h2 class="section-heading">Project Yang Pernah Dikerjakan</h2>
                    <div class="form-group">
                        <label for="judul" class="sr-only">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul">
                    </div>
                    <div class="form-group">
                        <label for="tempat" class="sr-only">Tempat</label>
                        <input type="text" name="tempat" id="tempat" class="form-control" placeholder="Tempat">
                    </div>
                    <div class="form-group">
                        <input type="month" name="bulan" id="bulan" class="form-control" placeholder="Tanggal Mulai">
                    </div>
                    <div class="form-group">
                        <input type="month" name="bulan" id="bulan" class="form-control" placeholder="Tanggal Berakhir">
                    </div>
                </section>

                <h3>Step 3 Title</h3>
                <section>
                    <h5 class="bd-wizard-step-title">Langkah 3</h5>
                    <h2 class="section-heading mb-5">Upload Dokumen Yang Diperlukan</h2>
                    <h6 class="font-weight-bold">Select business type</h6>
                    <p class="mb-4" id="business-type">Branding</p>
                    <h6 class="font-weight-bold">Enter your Account Details</h6>
                    <p class="mb-4"><span id="enteredFirstName">Cha</span> <span id="enteredLastName">Ji-Hun C</span> <br>
                        Phone: <span id="enteredPhoneNumber">+230-582-6609</span> <br>
                        Email: <span id="enteredEmailAddress">willms_abby@gmail.com</span></p>
                </section>

                <h3>Step 4 Title</h3>
                <section>
                    <h5 class="bd-wizard-step-title">Langkah 4</h5>
                    <h2 class="section-heading">Isi Formulir Kepuasan</h2>
                    <a href="https://sukma.jatimprov.go.id/fe/survey?idUser=1992" class="btn btn-primary" style="background-color: #DC143C;">Isi Formulir Kepuasan</a>
                </section>

            </div>
        </form>
    </div>
</main>