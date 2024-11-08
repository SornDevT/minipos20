<template lang="">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4" >
                <div class="card-body">
                    <div class="input-group">
          
          <input type="text" class=" form-control" placeholder="ຄົ້ນຫາສິນຄ້າ...">
          <button class="btn btn-primary p-2" type="button" ><i class='bx bx-search-alt'></i></button>
        </div>

                    
                </div>
            </div>
            <PerfectScrollbar>
                <div style="height:65vh">
                <div class="row">
                    <div class="col-md-3 mb-4" v-for=" i in 30 " :key="i" >
                        <div class="card h-100">
                            <img class="card-img-top" :src="url + '/assets/img/elements/2.jpg'" alt="Card image cap">
                            <div class="card-body p-1">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text text-center">120,000</p>
                                
                            </div>
                            </div>
                    </div>
                </div>
            </div>
            </PerfectScrollbar>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3">
                        <label>ຊື່ລູກຄ້າ:</label>
                        <input type="text" class=" form-control mb-1" placeholder="..." >
                        <label>ເບີໂທ:</label>
                        <input type="text" class=" form-control mb-1" placeholder="..." >
                    </div>
                    <div class=" p-2 bg-info text-white">
                        ລາຍການສັ່ງຊື້
                    </div>
                    <PerfectScrollbar>
                    <div style=" height:42vh">
                        <table class="table table-bordered ">
                            <tbody>
                                <tr v-for="i in 20" :key="i">
                                    <td class="p-1 d-flex ">
                                        <img :src="url + '/assets/img/no-img.jpg'" class="list-img">
                                        <div class=" ms-2 w-100 pe-2">
                                             <span>name product</span>
                                             <div class=" text-end">2 x 120,000</div>
                                             <div class=" d-flex justify-content-between"> 
                                                <span><i class='bx bxs-plus-circle fs-5 text-info cursor-pointer'></i> | <i class='bx bxs-minus-circle fs-5 text-warning cursor-pointer'></i> | <i class='bx bxs-trash fs-5 text-danger cursor-pointer'></i></span>
                                                <span>240,000</span>
                                             </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </PerfectScrollbar>
                        <div class="p-2 bg-info text-white d-flex justify-content-between">
                            <span>ລວມຍອດເງິນ:</span>
                            <span>120,000 ກີບ</span>
                        </div>
                        <div class=" p-2">
                            <button type="button" class="btn rounded-pill btn-success w-100 ">ຊຳລ່ະເງິນ</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            url: window.location.origin
        }
    },
}
</script>
<style scoped>
    .list-img{
        width: 70px;
    height: 70px;
    object-fit: cover;
    object-position: center;
    border: 1px solid #dbdada;
    padding: 2px;
    border-radius: 5px;
    }
</style>