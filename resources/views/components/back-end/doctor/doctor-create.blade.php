<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Doctor Add</h4>
            </div>
        </div>

        <div class="card">
  
            <div class="card-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label">Photo</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="DoctorImage">
                                <label class="form-label">email *</label>
                                <input type="text" class="form-control" id="DoctorEmail">
                                <label class="form-label">Chamber Address *</label>
                                <input type="text" class="form-control" id="ChamberAddress">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control" id="DoctorName">
                                <label class="form-label">Specialization*</label>
                                <input type="text" class="form-control" id="Doctorspecialization">  
                            </div>
                            <div class="col-md-3 p-1">                             
                                <label class="form-label">Degree *</label>
                                <input type="text" class="form-control" id="DoctorDegree">
                                <label class="form-label">Hospital *</label>
                                <input type="text" class="form-control" id="DoctorHospital">
                            </div>
                                <div class="col-md-3 p-1">
                                <label class="form-label">mobile *</label>
                                <input type="text" class="form-control" id="DoctorMobile">
                                <label class="form-label">registration_number *</label>
                                <input type="text" class="form-control" id="DoctorRegistrationNumber">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    async function Save() {
        try {
            let DoctorEmail = document.getElementById('DoctorEmail').value;
            let ChamberAddress = document.getElementById('ChamberAddress').value;
            let DoctorName = document.getElementById('DoctorName').value;
            let Doctorspecialization = document.getElementById('Doctorspecialization').value;
            let DoctorDegree = document.getElementById('DoctorDegree').value;
            let DoctorHospital = document.getElementById('DoctorHospital').value;
            let DoctorMobile = document.getElementById('DoctorMobile').value;
            let DoctorRegistrationNumber = document.getElementById('DoctorRegistrationNumber').value;
            let imgInput = document.getElementById('DoctorImage');

            if (!imgInput.files || imgInput.files.length === 0) {
                errorToast("Photo Required !");
                return;
            }

            let imgFile = imgInput.files[0];

            if (DoctorEmail.length === 0) {
                errorToast("Cast Name Required !");
            } else if (ChamberAddress.length === 0) {
                errorToast("Cast Title Required !");
            } 
            
            else if (DoctorName.length === 0) {
                errorToast("Cast View Link Required !");
            } 
            
            else if (Doctorspecialization.length === 0) {
                errorToast("Cast View Link Required !");
            } 
            
            else if (DoctorDegree.length === 0) {
                errorToast("Cast View Link Required !");
            } 
            
            else if (DoctorHospital.length === 0) {
                errorToast("Cast View Link Required !");
            } 
            
            else if (DoctorMobile.length === 0) {
                errorToast("Cast View Link Required !");
            } 
            
            else if (DoctorRegistrationNumber.length === 0) {
                errorToast("Cast View Link Required !");
            } 
            
            else {
                document.getElementById('modal-close').click();
                let formData = new FormData();
                formData.append('name',DoctorName );
                formData.append('email',DoctorEmail);
                formData.append('registration_number',DoctorRegistrationNumber );
                formData.append('specialization', Doctorspecialization);
                formData.append('degree', DoctorDegree);
                formData.append('hospital', DoctorHospital);
                formData.append('chamber_address',ChamberAddress );
                formData.append('mobile',DoctorMobile );
                formData.append('img', imgFile);

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        ...HeaderToken().headers
                    }
                }

                showLoader();
                let res = await axios.post("/create-doctor", formData, config);
                hideLoader();

                if (res.data['status'] === "success") {
                    successToast(res.data['message']);
                    document.getElementById("save-form").reset();
                    await getList();
                } else {
                    errorToast(res.data['message'])
                }
            }

        } catch (e) {
            unauthorized(e.response.status)
        }
    }
</script>







