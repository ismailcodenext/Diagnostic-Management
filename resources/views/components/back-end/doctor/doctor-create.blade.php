<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Doctor</h6>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <br/>
                                <img class="w-15" id="newImg" src="{{asset('images/default.jpg')}}"/>
                                <br/>
                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="DoctorImage">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control" id="DoctorName">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-control" id="DoctorEmail">
                                <label class="form-label">Specialization *</label>
                                <input type="text" class="form-control" id="DoctorSpecialization">
                                <label class="form-label">Degree *</label>
                                <input type="text" class="form-control" id="DoctorDegree">
                                <label class="form-label">Mobile *</label>
                                <input type="text" class="form-control" id="DoctorMobile">
                                <label class="form-label">Doctor Hospital *</label>
                                <input type="text" class="form-control" id="DoctorHospital">
                                <label class="form-label">Doctor Chamber Address *</label>
                                <input type="text" class="form-control" id="DoctorChamberAddress">
                                <label class="form-label">Doctor Registration Number *</label>
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
<script>
    async function Save() {
        try {
            let imgInput = document.getElementById('DoctorImage');
            let DoctorName = document.getElementById('DoctorName').value;
            let DoctorEmail = document.getElementById('DoctorEmail').value;
            let DoctorSpecialization = document.getElementById('DoctorSpecialization').value;
            let DoctorDegree = document.getElementById('DoctorDegree').value;
            let DoctorMobile = document.getElementById('DoctorMobile').value;
            let DoctorHospital = document.getElementById('DoctorHospital').value;
            let DoctorChamberAddress = document.getElementById('DoctorChamberAddress').value;
            let DoctorRegistrationNumber = document.getElementById('DoctorRegistrationNumber').value;


            if (!imgInput.files || imgInput.files.length === 0) {
                errorToast("Photo Required !");
                return;
            }

            let imgFile = imgInput.files[0];

            if (DoctorName.length === 0) {
                errorToast("Doctor Name Required !");
            }
            
            else if (DoctorEmail.length === 0) {
                errorToast("Doctor Email Required !");
            } 
            
            else if (DoctorSpecialization.length === 0) {
                errorToast("Doctor Specialization Required !");
            } 
            
            else if (DoctorDegree.length === 0) {
                errorToast("Doctor Degree Required !");
            } 
            
            else if (DoctorHospital.length === 0) {
                errorToast("Doctor Hospital Required !");
            } 
            
            else if (DoctorChamberAddress.length === 0) {
                errorToast("Doctor ChamberAddress Required !");
            } 
            
            else if (DoctorRegistrationNumber.length === 0) {
                errorToast("Doctor RegistrationNumber Required !");
            } 
            
            
            else if (DoctorMobile.length === 0) {
                errorToast("Doctor Mobile Required !");
            } else {
                document.getElementById('modal-close').click();
                let formData = new FormData();
                formData.append('name', DoctorName);
                formData.append('email', DoctorEmail);
                formData.append('specialization', DoctorSpecialization);
                formData.append('degree', DoctorDegree);
                formData.append('mobile', DoctorMobile);
                formData.append('hospital', DoctorHospital);
                formData.append('chamber_address', DoctorChamberAddress);
                formData.append('registration_number', DoctorRegistrationNumber);
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
