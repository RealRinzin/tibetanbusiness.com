<template>
    <div>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <button class="btn btn-info btn-md my-3">Add New Restaurant</button>
                <table class="table table-striped table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Banner</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Location</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Status</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                    <label class="custom-control-label" for="customSwitch3"></label>
                                    </div>
                                </div>
                            </td>
                            <td><button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt  px-1"></i></button></td>
                            <td><button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt  px-1"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    

    mounted(){
        axios.get('/api/user/restaurants'
        ,{headers : { Authorization : localStorage.getItem("token")}
        }).then(response => {
            console.log(response.data);
        })
    }
}
</script>