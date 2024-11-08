<template lang="">
    <div class="card">
  <h5 class="card-header">ລາຍການ ສະຕ໋ອກສິນຄ້າ</h5>
  <div class="card-body">

    <div v-if="ShowForm">
        {{ FormStore }}
        <hr>
        <div class="row">
            <div class="col-md-4 text-center" style=" position:relative">
                <button type="button" v-if="FormStore.image" @click="RemoveImg()" class="btn rounded-pill btn-icon btn-danger btimg">
                    <i class='bx bx-x-circle fs-3'></i>
              </button>
                <img :src="ImagePreview" @click="$refs.img_store.click()" style=" width:70%" class=" cursor-pointer">
                <input type="file" ref="img_store" style=" display:none" @change="onSelect($event)" >
            </div>
            <div class="col-md-8">
                <div class="mb-2">
                    <label  class="form-label">ຊື່ສິນຄ້າ:</label>
                    <input type="text" class="form-control" v-model="FormStore.name"  placeholder="..." >
                </div>
                <div class="mb-2">
                    <label  class="form-label">ຈຳນວນ:</label>
                    <cleave :options="options"  class="form-control" v-model="FormStore.qty"  placeholder="..." />
                </div>
                <div class="row">
                    <div class=" col-md-6 mb-2">
                        <label  class="form-label">ລາຄາຊື້:</label>
                        <div class="input-group">
                            <cleave :options="options" class="form-control" v-model="FormStore.price_buy" placeholder="..." />
                            <span class="input-group-text" id="basic-addon11">ກີບ</span>
                        </div>

                    </div>
                    <div class="col-md-6 mb-2">
                        <label  class="form-label">ລາຄາຂາຍ:</label>
                        <div class="input-group">
                            <cleave :options="options" class="form-control" v-model="FormStore.price_sell"  placeholder="..." />
                            <span class="input-group-text" id="basic-addon11">ກີບ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" d-flex justify-content-end ">
            <button type="button" class="btn btn-success me-2" :disabled="CheckForm" @click="SaveStore()" >ບັນທຶກ</button>
            <button type="button" class="btn btn-warning" @click="CancelStore()">ຍົກເລີກ</button>
        </div>
    </div>

    <div class="table-responsive text-nowrap" v-else>
        <div class=" d-flex justify-content-between mb-2">
            <div class=" d-flex">
                <div class=" d-flex align-items-center me-2 cursor-pointer " @click="ChangeSort()" >
                    <i class='bx bx-sort-down fs-3' v-if="Sort=='desc'"></i>
                    <i class='bx bx-sort-up fs-3' v-if="Sort=='asc'"></i>
                </div>
                
                <select v-model="PerPage" class=" form-select" @change="GetStore()" >
                    <option value="5" >5</option>
                    <option value="10" >10</option>
                    <option value="20" >20</option>
                    <option value="30" >30</option>
                </select>
            </div>
            <div class=" d-flex">
                <div class="input-group me-2">
                    <input type="text" class="form-control" v-model="Search" @keyup.enter="GetStore()"  placeholder="ຄົ້ນຫາ...">
                    <button class="btn btn-primary p-2 " type="button" @click="GetStore()" ><i class='bx bx-search-alt fs-5'></i></button>
                </div>
                <button type="button" class="btn btn-info" @click="AddStore()" >ເພີ່ມຂໍ້ມູນ</button>
            </div>
        </div>
        <!-- {{ StoreData }} -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center" width="120">ຮູບພາບ</th>
            <th class="text-center">ຊື່ສິນຄ້າ</th>
            <th class="text-center">ຈຳນວນ</th>
            <th class="text-center">ລາຄາຊື້</th>
            <th class="text-center">ຈັດການ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for=" item in StoreData.data" :key="item.id" >
            <td> {{ item.id }} </td>
            <td>
                <img :src="url + '/assets/img/'+ item.image" v-if="item.image" class="list-jmg-store" >
                <img :src="url + '/assets/img/no-img.jpg'" v-else class="list-jmg-store" >
                </td>
            <td>{{ item.name }}</td>
            <td>
             {{ item.qty }}
            </td>
            <td class="text-end">{{ formatPrice(item.price_buy) }}</td>
            <td  class="text-center">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);" @click="EditStore(item.id)" ><i class="bx bx-edit-alt me-1"></i> ແກ້ໄຂ</a>
                  <a class="dropdown-item" href="javascript:void(0);" @click="DelStore(item.id)" ><i class="bx bx-trash me-1"></i> ລຶບ</a>
                </div>
              </div>
            </td>
          </tr>
         
          
        </tbody>
      </table>
      <button @click="showAlert">Hello world</button>
      <Pagination :pagination="StoreData" :offset="4" @paginate="GetStore($event)" />
    </div>


  </div>
</div>
</template>
<script>
import axios from 'axios';
import { useStore } from '../Store/auth'

export default {
    setup(){

        const store = useStore()
        return { store }

    },
    data() {
        return {
            url: window.location.origin,
            ImagePreview: window.location.origin + '/assets/img/upload.jpg',
            ShowForm: false,
            FormType: true,
            StoreData:[],
            EditID:'',
            FormStore: {
                name:'',
                image:'',
                qty:'',
                price_buy:'',
                price_sell:''
            },
            Sort:'desc',
            PerPage: 5,
            Search:'',
            options: {
                  numeral: true,
                  numeralPositiveOnly: true,
                  noImmediatePrefix: true,
                  rawValueTrimPrefix: true,
                  numeralIntegerScale: 10,
                  numeralDecimalScale: 2,
                  numeralDecimalMark: '.',
                  delimiter: ','
                }
        }
    },
    computed:{
        CheckForm(){
            if(this.FormStore.name == '' || this.FormStore.qty == '' || this.FormStore.price_buy == '' || this.FormStore.price_sell == ''){
                return true
            } else {
                return false
            }
        }
    },
    methods:{
        RemoveImg(){
            this.FormStore.image = ''
            this.ImagePreview = window.location.origin + '/assets/img/upload.jpg'
        },
        showAlert() {
      // Use sweetalert2
      this.$swal({
                        // title: "ການລຶບຂໍ້ມູນບໍ່ສຳເລັດ!",
                        text: "Your file has been deleted.",
                        showConfirmButton:false,
                        icon: "success",
                        timer: 2500
                    });
            },
        onSelect(event){
            // console.log(event)

            this.FormStore.image = event.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(this.FormStore.image);
            reader.addEventListener("load", function(){
                this.ImagePreview = reader.result
            }.bind(this,false));
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        ChangeSort(){
            if(this.Sort == 'asc'){
                this.Sort = 'desc'
            } else {
                this.Sort = 'asc'
            }
            this.GetStore()
        },
        AddStore(){
            this.ShowForm = true
            this.FormType = true
            this.ImagePreview = window.location.origin + '/assets/img/upload.jpg'
        },
        CancelStore(){
            this.ShowForm = false
        },
        EditStore(id){
            this.EditID = id
            this.FormType = false

            axios.get(`api/store/edit/${id}`,{ headers:{ Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{

                this.FormStore = res.data
                // ສະແດງຟອມ
                this.ShowForm = true

                // ກວດຮູບພາບ
                if(res.data.image){
                    this.ImagePreview = this.url + '/assets/img/' + res.data.image
                } else {
                    this.ImagePreview =  this.url + '/assets/img/upload.jpg';
                }

            }).catch((error)=>{
                console.log(error.response.status)
            })
        },
        DelStore(id){


            this.$swal({
            title: "ທ່ານແນ່ໃຈບໍ່?",
            text: "ທີ່ຈະລຶບຂໍ້ມູນນີ້!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ຍືນຍັນລຶບ!",
            cancelButtonText:"ຍົກເລີກ"
            }).then((result) => {
            if (result.isConfirmed) {


                axios.delete(`api/store/delete/${id}`,{ headers:{ Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{
                if(res.data.success){

                    this.$swal({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });

                    // ອັບເດດລາຍການ
                    this.GetStore()
                    } else {

                        this.$swal({
                        title: "ການລຶບຂໍ້ມູນບໍ່ສຳເລັດ!",
                        text: res.data.message,
                        icon: "error"
                    });

                    }
                }).catch((error)=>{
                    console.log(error)
                    if( typeof error.response !=='undefined'){
                        this.$swal({
                            title: "ການລຶບຂໍ້ມູນບໍ່ສຳເລັດ!",
                            text: error.response.data.message,
                            icon: "error"
                        });
                    }
                })
                
                
            }
            });


           
        },
        SaveStore(){

            if(this.FormType){
                // ເພີ່ມຂໍ້ມູນໃໝ່
                axios.post('api/store/add',this.FormStore,{ headers:{ "Content-Type":"multipart/form-data", Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{

                    // console.log(res)

                        if(res.data.success){

                            this.FormStore.name = ''
                            this.FormStore.image = ''
                            this.FormStore.qty = ''
                            this.FormStore.price_buy = ''
                            this.FormStore.price_sell = ''

                            // ປິດຟອມ
                            this.ShowForm = false

                            // ອັບເດດລາຍການ
                            this.GetStore()

                            this.$swal({
                                text: res.data.message,
                                showConfirmButton:false,
                                icon: "success",
                                timer: 2500
                            });

                        } else {
                            this.$swal({
                                text: res.data.message,
                                showConfirmButton:false,
                                icon: "error",
                                timer: 2500
                            });
                        }

                    }).catch((error)=>{
                    console.log(error)
                        if( typeof error.response !=='undefined'){
                            this.$swal({
                                title: "ມີຂໍ້ຜິດຜາດ!",
                                text: error.response.data.message,
                                icon: "error"
                            });
                        }
                    })

            } else {

                // ອັບເດດຂໍ້ມູນ
                axios.post(`api/store/update/${this.EditID}`, this.FormStore,{ headers:{ "Content-Type":"multipart/form-data", Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{
                  
                    if(res.data.success){

                        this.FormStore.name = ''
                            this.FormStore.image = ''
                            this.FormStore.qty = ''
                            this.FormStore.price_buy = ''
                            this.FormStore.price_sell = ''

                            // ປິດຟອມ
                            this.ShowForm = false

                            // ອັບເດດລາຍການ
                            this.GetStore()

                            this.$swal({
                                text: res.data.message,
                                showConfirmButton:false,
                                icon: "success",
                                timer: 2500
                            });

                    } else {


                        this.$swal({
                                text: res.data.message,
                                showConfirmButton:false,
                                icon: "error",
                                timer: 2500
                            });

                    }

                }).catch((error)=>{
                    console.log(error);
                    if( typeof error.response !=='undefined'){
                            this.$swal({
                                title: "ມີຂໍ້ຜິດຜາດ!",
                                text: error.response.data.message,
                                icon: "error"
                            });
                        }
                })

            }

            
        },
        GetStore(page){

            axios.get(`api/store?page=${page}&sort=${this.Sort}&perpage=${this.PerPage}&search=${this.Search}`,{ headers:{ Authorization: 'Bearer ' + this.store.get_token } }).then((res)=>{

                this.StoreData = res.data;

            }).catch((error)=>{
                // console.log(error)
                console.log(error)
                if( typeof error.response !=='undefined'){
                            if(error.response.status== 401){

                                // ເຄີຍຂໍ້ມູນໃນ localstorage
                                localStorage.removeItem("web_token")
                                localStorage.removeItem("web_user")

                                // ເຄຍ token ໃນ pinia
                                this.store.remove_token()
                                this.store.remove_user()

                                // go to login
                                this.$router.push("/login")
                                
                            } else {
                                this.$swal({
                                        title: "ມີຂໍ້ຜິດຜາດ!",
                                        text: error.response.data.message,
                                        icon: "error"
                                    });
                            }
                            
                        }
            })

        }
    },
    created(){
        this.GetStore()
    },
    watch:{
        Search(){
            if(this.Search == ''){
                this.GetStore()
            }
        }
    }
}
</script>
<style scoped >
    .btimg{
        position: absolute;
        top: 0px;
        right: 10px;
    }
    .list-jmg-store{
        width: 80px;
        border: 1px solid #d3d3d3;
        padding: 2px;
        border-radius: 5px;
    }
</style>