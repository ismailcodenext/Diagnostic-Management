<div class="card-body mt-5">
    <div class="table-responsive">
        <table class="table" id="tableData">
            <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Specialization</th>
                <th>Degree</th>
                <th>Mobile</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="tableList">

            </tbody>
        </table>
    </div>
</div>

<script>

    getList();

    async function getList() {

        try {
            showLoader();
            let res=await axios.get("/list-doctor",HeaderToken());
            hideLoader();

            let tableList=$("#tableList");
            let tableData=$("#tableData");

            tableData.DataTable().destroy();
            tableList.empty();

            res.data['doctor_data'].forEach(function (item,index) {
                let row=`<tr>
                <td>${index+1}</td>
                <td><img class="w-60 h-auto" alt="" src="${item['img_url']}"></td>
                <td>${item['name']}</td>
                <td>${item['email']}</td>
                <td>${item['specialization']}</td>
                <td>${item['degree']}</td>
                <td>${item['mobile']}</td>
            </tr>`
                tableList.append(row)
            })

            $('.editBtn').on('click', async function () {
                let id= $(this).data('id');
                await FillUpUpdateForm(id)
                $("#update-modal").modal('show');
            })

            $('.deleteBtn').on('click',function () {
                let id= $(this).data('id');
                $("#delete-modal").modal('show');
                $("#deleteID").val(id);
            })
            new DataTable('#tableData',{
                    order:[[0,'desc']],
                    lengthMenu:[5,10,15,20,30]
                }
            );

        }catch (e) {
            unauthorized(e.response.status)
        }

    }


</script>
