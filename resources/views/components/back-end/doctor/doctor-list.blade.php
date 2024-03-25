<div class="page-wrapper">
    <div class="content">
    <div class="page-header">
    <div class="page-title">
    <h4>Product List</h4>
    <h6>Manage your products</h6>
    </div>
    <div class="page-btn">
    <a href="addproduct.html" class="btn btn-added"><img src="{{asset('front-end/assets/img/icons/plus.svg')}}" alt="img" class="me-1">Add New Product</a>
    </div>
    </div>

    <div class="card">
    <div class="card-body">
    <div class="table-top">
    <div class="search-set">
    <div class="search-path">
    <a class="btn btn-filter" id="filter_search">
    <img src="{{asset('front-end/assets/img/icons/filter.svg')}}" alt="img">
    <span><img src="{{asset('front-end/assets/img/icons/closes.svg')}}" alt="img"></span>
    </a>
    </div>
    <div class="search-input">
    <a class="btn btn-searchset"><img src="{{asset('front-end/assets/img/icons/search-white.svg')}}" alt="img"></a>
    </div>
    </div>
    <div class="wordset">
    <ul>
    <li>
    <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{asset('front-end/assets/img/icons/pdf.svg')}}" alt="img"></a>
    </li>
    <li>
    <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{asset('front-end/assets/img/icons/excel.svg')}}" alt="img"></a>
    </li>
    <li>
    <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{asset('front-end/assets/img/icons/printer.svg')}}" alt="img"></a>
    </li>
    </ul>
    </div>
    </div>

    <div class="card mb-0" id="filter_inputs">
    <div class="card-body pb-0">
    <div class="row">
    <div class="col-lg-12 col-sm-12">
    <div class="row">
    <div class="col-lg col-sm-6 col-12">
    <div class="form-group">
    <select class="select">
    <option>Choose Product</option>
    <option>Macbook pro</option>
    <option>Orange</option>
    </select>
    </div>
    </div>
    <div class="col-lg col-sm-6 col-12">
    <div class="form-group">
    <select class="select">
    <option>Choose Category</option>
    <option>Computers</option>
    <option>Fruits</option>
    </select>
    </div>
    </div>
    <div class="col-lg col-sm-6 col-12">
    <div class="form-group">
    <select class="select">
    <option>Choose Sub Category</option>
    <option>Computer</option>
    </select>
    </div>
    </div>
    <div class="col-lg col-sm-6 col-12">
    <div class="form-group">
    <select class="select">
    <option>Brand</option>
    <option>N/D</option>
    </select>
    </div>
    </div>
    <div class="col-lg col-sm-6 col-12 ">
    <div class="form-group">
    <select class="select">
    <option>Price</option>
    <option>150.00</option>
    </select>
    </div>
    </div>
    <div class="col-lg-1 col-sm-6 col-12">
    <div class="form-group">
    <a class="btn btn-filters ms-auto"><img src="{{asset('front-end/assets/img/icons/search-whites.svg')}}" alt="img"></a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="table-responsive">
    <table class="table  datanew" id="tableData">
    <thead>
    <tr>
    <th>
    <label class="checkboxs">
    <input type="checkbox" id="select-all">
    <span class="checkmarks"></span>
    </label>
    </th>
    <th>No</th>
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
    </div>

    </div>
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
                    <td><img class="w-30 h-auto" alt="" src="${item['img_url']}"></td>
                    <td>${item['name']}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
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
        });


    }catch (e) {
        unauthorized(e.response.status)
    }

}


</script>
